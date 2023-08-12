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
use App\Models\AnalyticsModels\ArrayObject;
use Illuminate\Database\Eloquent\Builder;

class AnalyticsService implements BusinessIntelligence {

    protected User $user;

    public function __construct() {
        $this->user = Auth::user();
    }

    public function purchase_statistics(): MonthStat {
        // $daysAgo = intval(date('d'));
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfDay();
        if($this->user->hasRole('admin')) {
            $purchases = Purchase::whereBetween('created_at', [$startDate, $endDate]);
            // ->whereDate('created_at', '<=', $endDate);
        } else {
            $id = $this->user->warehouse->id;
            $purchases = Purchase::whereBetween('created_at', [$startDate, $endDate])
            ->where('warehouse_id', $id);
            // ->whereHas('warehouse', function ($query) use ($id) {
            //     $query->where('warehouse_id', $id);
            // })->with('warehouse');
            
        }

        $stat = new MonthStat();
        $stat->name = "Purchases";
        $stat->total = $purchases->get()->count();
        $stat->pending = $purchases->pending()->get()->count();
        $stat->completed =  $purchases->complete()->get()->count();
        $stat->products = $purchases->products()->count();
        $stat->amount = $this->shortenMoney($purchases->cost());
        return $stat;
    }

    public function sales_statistics(): MonthStat {
        $daysAgo = intval(date('d'));
        $startDate = Carbon::now()->subDays($daysAgo)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        if($this->user->hasRole('admin')) {
            $purchases = Sale::whereBetween('created_at', [$startDate, $endDate]);
        } else {
            $id = $this->user->warehouse->id;
            $purchases = Sale::whereBetween('created_at', [$startDate, $endDate])->where('warehouse_id', $id);
            
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


    // public function totalSale(): int {
    //     if($this->user->hasRole('admin')) {
    //         $purchases = Sale::all()->count();
    //     } else {
    //         $purchases = Sale::where('warehouse_id', $this->user->warehouse->id)->count();
    //     }
    //     return $purchases;
    // }

    // public function totalPurchase(): int {
    //     if($this->user->hasRole('admin')) {
    //         $purchases = Purchase::all()->count();
    //     } else {
    //         $purchases = Purchase::where('warehouse_id', $this->user->warehouse->id)->count();
    //     }
    //     return $purchases;
    // }

    public function totalPurchaseReturn(): int {
        if($this->user->hasRole('admin')) {
            $purchases = PurchaseReturn::all()->count();
        } else {
            $purchases = PurchaseReturn::whereHas('owner', function($query) {
                $query->where('warehouse_id', $this->user->warehouse->id);
            })->with('owner')->get()->count();
        }
        return $purchases;
    }

    public function totalSaleReturn(): int {
        if($this->user->hasRole('admin')) {
            $purchases = SaleReturn::all()->count();
        } else {
            $id = $this->user->warehouse->id;
            $purchases = SaleReturn::whereHas('owner', function($query) use ($id) { 
                $query->where('warehouse_id', $id);
            })->with('owner')->get()->count();
        }
        return $purchases;
    }

    public function totalPurchaseAmount(): int {
        $start = Carbon::now()->startOfYear();
        $end = Carbon::now()->endOfYear();
        if($this->user->hasRole('admin')) {
            $purchases = Purchase::whereBetween('created_at', [$start, $end])->get();
        } else {
            $purchases = Purchase::whereBetween('created_at', [$start, $end])
            ->whereHas('owner', function($query) {
                $query->where('warehouse_id', $this->user->warehouse->id);
            })->with('owner')->get();
        }
        $total = $purchases->sum('total_price');
        $discount = $purchases->sum('discount_amount');
        return $total - $discount;
    }

    public function totalSaleAmount(): int {
        $start = Carbon::now()->startOfYear();
        $end = Carbon::now()->endOfYear();
        if($this->user->hasRole('admin')) {
            $purchases = Sale::whereBetween('created_at', [$start, $end])->get();
        } else {
            $id = $this->user->warehouse->id;
            $purchases = Sale::whereBetween('created_at', [$start, $end])
            ->whereHas('owner', function($query) use ($id) { 
                $query->where('warehouse_id', $id);
            })->with('owner')->get();
        }
        $total = $purchases->sum('total_price');
        $discount = $purchases->sum('discount_amount');
        return $total - $discount;
    }

    public function recentSaleReturns() {
        if($this->user->hasRole('admin')) {
            $purchases = SaleReturn::whereHas('owner')->take(10)->get();
        } else {
            $id = $this->user->warehouse->id;
            $purchases = SaleReturn::whereHas('owner', function($query) use ($id) {
                $query->where('warehouse_id', $id);
            })->with('owner')->take(10)->get();
        }
        return $purchases;
    }

    public function productLow() {
        $user = $this->user;
        
        $products = Product::with('productStock')
        ->get()->filter(function($product) use($user) {
            return $product->totalInStock($user) <= $product->alert;
        });
        return $products;
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
            $id = $this->user->warehouse->id;
            $sales = Sale::where('warehouse_id', $id)->whereBetween('created_at', [$startDate, $endDate])->get();
            $salesReturn = SaleReturn::whereHas('owner', function($query) use ($id, $startDate, $endDate) {
                $query->where('warehouse_id', )->whereBetween('created_at', [$startDate, $endDate]);
            })->with('owner')->get(); 

            $purchases = Purchase::where('warehouse_id', $id)->whereBetween('created_at', [$startDate, $endDate])->get();
            $purchaseReturns = PurchaseReturn::whereHas('owner', function($query) use ($id, $startDate, $endDate) {
                $query->where('warehouse_id', )->whereBetween('created_at', [$startDate, $endDate]);
            })->with('owner')->get();
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
            $id = $this->user->warehouse->id;
            $sales = Sale::where('warehouse_id', $id)->whereBetween('created_at', [$startDate, $endDate])->get();
            $salesReturn = SaleReturn::whereHas('owner', function($query) use ($id, $startDate, $endDate) {
                $query->where('warehouse_id', )->whereBetween('created_at', [$startDate, $endDate]);
            })->with('owner')->get();
            //where('warehouse_id', $this->user->warehouse->id)->whereBetween('created_at', [$startDate, $endDate])->get();
            
            $purchases = Purchase::where('warehouse_id', $id)->whereBetween('created_at', [$startDate, $endDate])->get();
            $purchaseReturns = PurchaseReturn::whereHas('owner', function($query) use ($id, $startDate, $endDate) {
                $query->where('warehouse_id', )->whereBetween('created_at', [$startDate, $endDate]);
            })->with('owner')->get();
            //where('warehouse_id', $this->user->warehouse->id)->whereBetween('created_at', [$startDate, $endDate])->get();
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


    public function salesReport() {
        $start = Carbon::now()->startOfYear();
        $end = Carbon::now()->endOfYear();

        if($this->user->hasRole('admin')) {
            $purchases = Sale::whereBetween('created_at', [$start, $end]);
        } else {
            $id = $this->user->warehouse->id;
            $purchases = Sale::whereBetween('created_at', [$start, $end])
            ->where('warehouse_id', $id);
        }

        $flattened = $this->flattenReport($purchases, $start, $end);
        return json_encode($flattened);
    }

    public function purchaseReport() {
        $start = Carbon::now()->startOfYear();
        $end = Carbon::now()->endOfYear();

        if($this->user->hasRole('admin')) {
            $purchases = Purchase::whereBetween('created_at', [$start, $end]);
        } else {
            $id = $this->user->warehouse->id;
            $purchases = Purchase::whereBetween('created_at', [$start, $end])
            ->where('warehouse_id', $id);
        }
        $flattened = $this->flattenReport($purchases, $start, $end);
        return json_encode($flattened);
    }

    function flattenReport(Builder $collection, $start, $end) {
        $flattened = [];
        
        $result = $collection->get()->groupBy(function($record) {
            return Carbon::parse($record->created_at)->format('Y-m');
        })->map(function($group) {
            $total = $group->sum('total_price');
            $discount = $group->sum('discount_amount');
            return $total - $discount;
        })->all();

        // dd($result);
        $months = [];
        $current_date = Carbon::now()->startOfYear();

        while($current_date <= Carbon::parse($end)) {
            $current_month = $current_date->format('Y-m');

            if(isset($result[$current_month])) {
             $value = new ArrayObject($current_month, $result[$current_month]);
            } else {
                $value = new ArrayObject($current_month, 0);
            }
            array_push($flattened, $value);
            array_push($months, $current_date->format('n'));
            $current_date->addMonth();
        }

        if(count($flattened) < 12) {
            // $remainder = 12 - count($flattened);
            for($i = 1; $i < 12; $i++) {
                if(!in_array($i, $months)) {
                    $year = Carbon::now()->year;
                    $date = Carbon::parse("$i $year");
                    $obj = new ArrayObject($date->format('Y-m'), 0);
                    array_push($flattened, $obj);
                }
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