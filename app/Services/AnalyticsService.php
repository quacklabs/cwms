<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use App\Contracts\BusinessIntelligence;
use App\Models\AnalyticsModels\MonthStat;
use App\Models\AnalyticsModels\Trend;
use Carbon\Carbon;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\User;
use App\Models\PurchaseReturn;
use App\Models\SaleReturn;
use App\Models\Product;
use App\Models\SaleDetails;


class AnalyticsService implements BusinessIntelligence {

    protected User $user;

    public function __construct() {
        $this->user = Auth::user();
    }

    public function purchase_statistics(): MonthStat {
        $daysAgo = intval(date('d'));
        $startDate = Carbon::now()->subDays($daysAgo)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        if($this->user->hasRole('admin')) {
            $purchases = Purchase::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);
        } else {
            $purchases = Purchase::where('warehouse_id', $this->user->warehouse->id)->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);
        }

        
        $stat = new MonthStat();
        $stat->name = "Purchases";
        $stat->total = $purchases->get()->count();

        $stat->pending = $purchases->pending()->get()->count();
        $stat->completed = $purchases->complete()->get()->count();
        $stat->products = $purchases->products()->count();
        $stat->amount = $this->shortenMoney($purchases->cost());
        return $stat;
    }

    public function sales_statistics(): MonthStat {
        $daysAgo = intval(date('d'));
        $startDate = Carbon::now()->subDays($daysAgo)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        if($this->user->hasRole('admin')) {
            // $purchases = Purchase::whereDate('created_at', '>=', $startDate)
            // ->whereDate('created_at', '<=', $endDate);
            $purchases = Sale::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);
        } else {
            $purchases = Sale::where('warehouse_id', $this->user->warehouse->id)->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);
        }
        $stat = new MonthStat();
        $stat->name = "Sales";
        $stat->total = $purchases->get()->count();

        $stat->pending = $purchases->pending()->get()->count();
        $stat->completed = $purchases->complete()->get()->count();
        $stat->products = $purchases->products()->count();
        $stat->amount = $this->shortenMoney($purchases->cost());
        return $stat;
    }

    public function totalSale(): int {
        if($this->user->hasRole('admin')) {
            $purchases = Sale::all()->count();
        } else {
            $purchases = Sale::where('warehouse_id', $this->user->warehouse->id)->count();
        }
        return $purchases;
    }

    public function totalPurchase(): int {
        if($this->user->hasRole('admin')) {
            $purchases = Purchase::all()->count();
        } else {
            $purchases = Purchase::where('warehouse_id', $this->user->warehouse->id)->count();
        }
        return $purchases;
    }

    public function totalPurchaseReturn(): int {
        if($this->user->hasRole('admin')) {
            $purchases = PurchaseReturn::all()->count();
        } else {
            $purchases = PurchaseReturn::where('warehouse_id', $this->user->warehouse->id)->count();
        }
        return $purchases;
    }

    public function totalSaleReturn(): int {
        if($this->user->hasRole('admin')) {
            $purchases = SaleReturn::all()->count();
        } else {
            $purchases = SaleReturn::where('warehouse_id', $this->user->warehouse->id)->count();
        }
        return $purchases;
    }

    public function recentSaleReturns() {
        if($this->user->hasRole('admin')) {
            $purchases = SaleReturn::take(10)->get();
        } else {
            $purchases = SaleReturn::where('warehouse_id', $this->user->warehouse->id)->take(10)->get();
        }
        return $purchases;
    }

    public function productLow() {
        $productsLowStock = Product::whereHas('productStock', function ($query) {
            $query->where('sold_by', '=', null);
        })
        ->select('products.*')
        ->addSelect(DB::raw('(SELECT COUNT(*) FROM product_stock WHERE product_stock.product_id = products.id AND product_stock.sold_by IS NULL) as product_stock_count'))
        ->having('product_stock_count', '<=', DB::raw('products.alert'))->get();

        return $productsLowStock;
    }

    public function topProducts() {
        $start = Carbon::now()->startOfYear();
        $end = Carbon::now()->endOfDay();


        $topProducts = SaleDetails::select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(total) as total_value'))
        ->whereBetween('created_at', [$start, $end])
        ->groupBy('product_id')
        ->orderByDesc('total_quantity')
        ->take(5)
        ->with('product') // Eager loading the product details
        ->get();
        return $topProducts;
    }

    public function monthlyTrend() {
        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now()->endOfDay();
        $trends = [];
        if($this->user->hasRole('admin')) {
            $sales = Sale::whereBetween('created_at', [$startDate, $endDate])->get();
            $salesReturn = SaleReturn::whereBetween('created_at', [$startDate, $endDate])->get();
            $purchases = Purchase::whereBetween('created_at', [$startDate, $endDate])->get();
            $purchaseReturns = PurchaseReturn::whereBetween('created_at', [$startDate, $endDate])->get();
        } else {
            $sales = Sale::where('warehouse_id', $this->user->warehouse->id)->whereBetween('created_at', [$startDate, $endDate])->get();
            $salesReturn = SaleReturn::where('warehouse_id', $this->user->warehouse->id)->whereBetween('created_at', [$startDate, $endDate])->get();
            $purchases = Purchase::where('warehouse_id', $this->user->warehouse->id)->whereBetween('created_at', [$startDate, $endDate])->get();
            $purchaseReturns = PurchaseReturn::where('warehouse_id', $this->user->warehouse->id)->whereBetween('created_at', [$startDate, $endDate])->get();
        }

        $salesTrend = new Trend();
        $salesTrend->label = "Sales";
        $salesTrend->data = $this->flattenMonths($sales, $startDate, $endDate);

        $saleReturnTrend = new Trend();
        $saleReturnTrend->label = "Sales Returns";
        $saleReturnTrend->data = $this->flattenMonths($salesReturn, $startDate, $endDate);

        $purchaseTrends = new Trend();
        $purchaseTrends->label = "Purchases";
        $purchaseTrends->data = $this->flattenMonths($purchases, $startDate, $endDate);

        $purchaseReturnTrends = new Trend();
        $purchaseReturnTrends->label = "Purchase Returns";
        $purchaseReturnTrends->data = $this->flattenMonths($purchaseReturns, $startDate, $endDate);

        return json_encode([$salesTrend, $saleReturnTrend, $purchaseTrends, $purchaseReturnTrends], JSON_UNESCAPED_UNICODE);
    }

    public function flattenMonths(Collection $collection, $start, $end) {
        $current_date = Carbon::parse($start);
        $flattened = [];
        $result = $collection->groupBy(function($record) {
            return Carbon::parse($record->created_at)->format('Y-m');
        })->map(function($group) { return $group->count(); });

        while($current_date <= Carbon::parse($end)) {
            $current_month = $current_date->format('Y-m');
            $value = $result[$current_month] ?? 0;
            array_push($flattened, $value);
            $current_date->addMonth();
        }
        if(count($flattened) < 12) {
            $remainder = 12 - count($flattened);
            for($i = 1; $i < $remainder; $i++) {
                array_push($flattened, 0);
            }
        }
        return $flattened;
    }

    public function weeklyTrend() {
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        if($this->user->hasRole('admin')) {
            $sales = Sale::whereBetween('created_at', [$startDate, $endDate])->get();
            $salesReturn = SaleReturn::whereBetween('created_at', [$startDate, $endDate])->get();

            $purchases = Purchase::whereBetween('created_at', [$startDate, $endDate])->get();
            $purchaseReturns = PurchaseReturn::whereBetween('created_at', [$startDate, $endDate])->get();            
        } else {
            $sales = Sale::where('warehouse_id', $this->user->warehouse->id)->whereBetween('created_at', [$startDate, $endDate])->get();
            $salesReturn = SaleReturn::where('warehouse_id', $this->user->warehouse->id)->whereBetween('created_at', [$startDate, $endDate])->get();
            
            $purchases = Purchase::where('warehouse_id', $this->user->warehouse->id)->whereBetween('created_at', [$startDate, $endDate])->get();
            $purchaseReturns = PurchaseReturn::where('warehouse_id', $this->user->warehouse->id)->whereBetween('created_at', [$startDate, $endDate])->get();
        }

        $salesTrend = new Trend();
        $salesTrend->label = "Sales";
        $salesTrend->data = $this->flattenWeek($sales, $startDate, $endDate);

        $saleReturnTrend = new Trend();
        $saleReturnTrend->label = "Sales Returns";
        $saleReturnTrend->data = $this->flattenWeek($salesReturn, $startDate, $endDate);

        $purchaseTrends = new Trend();
        $purchaseTrends->label = "Purchases";
        $purchaseTrends->data = $this->flattenWeek($purchases, $startDate, $endDate);

        $purchaseReturnTrends = new Trend();
        $purchaseReturnTrends->label = "Purchase Returns";
        $purchaseReturnTrends->data = $this->flattenWeek($purchaseReturns, $startDate, $endDate);

        return json_encode([$salesTrend, $saleReturnTrend, $purchaseTrends, $purchaseReturnTrends]);
    }

    public function flattenWeek(Collection $collection, $start, $end) {
        $current_date = Carbon::parse($start);
        $flattened = [];
        $result = $collection->groupBy(function($record) {
            return Carbon::parse($record->created_at)->format('d');
        })->map(function($group) { return $group->count(); });

        while($current_date <= Carbon::parse($end)) {
            $current_day = $current_date->format('d');
            $value = $result[$current_day] ?? 0;
            array_push($flattened, $value);
            $current_date->addDay();
        }
        if(count($flattened) < 7) {
            $remainder = 7 - count($flattened);
            for($i = 1; $i < $remainder; $i++) {
                array_push($flattened, 0);
            }
        }
        return $flattened;
    }

    public function shortenMoney($value) {
        $suffixes = ["", "K", "M", "B"];
        $suffixIndex = 0;

        while($value >= 1000 && $suffixIndex < count($suffixes) - 1) {
            $value /= 1000;
            $suffixIndex = $suffixIndex + 1;
        }
        return round($value, 2) . $suffixes[$suffixIndex];
    }
}