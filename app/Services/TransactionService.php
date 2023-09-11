<?php
namespace App\Services;

use Carbon\Carbon;
use App\Contracts\TransactionInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Warehouse;
use App\Models\User;
use App\Models\Item;
use App\Model\SaleItem;
use App\Models\ProductStock;
use App\Models\Product;
use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnDetail;
use App\Models\SaleReturn;
use App\Models\SaleReturnDetail;

use Faker\Factory as Faker;
use Faker\Provider\Barcode;
use App\Events\CreateStockEvent;
use App\Events\SellStockEvent;
use App\Events\UpdatePurchaseEvent;
use App\Models\PurchaseDetails;

class TransactionService {
    
    public static function createPurchase(array $data): TransactionInterface {

        $orders = array_map(function($order) {
            return [
                'product_id' => $order->id,
                'quantity' => $order->quantity,
                'price' => $order->price,
                'total' => $order->total_price, 
                'serials' => $order->serials ?? "[]"
            ];
        }, json_decode($data['order']));

        $transaction = Purchase::create([
            'supplier_id' => $data['partner_id'],
            'invoice_no' => $data['invoice_no'],
            'total_price' => $data['total_price'],
            'status' => $data['order_status'],
            'discount_amount' => $data['discount_amount'],
            'date' => Carbon::parse($data['date']),
            'note' => $data['notes'] ?? NULL
        ]);
        $transaction->details()->createMany($orders);
        // if($flag == 'purchase') {
        //     event(new CreateStockEvent($orders));
        // } else {
        //     event(new SellStockEvent($orders, $transaction->id, $data['warehouse_id']));
        // }
        return $transaction;
    }

    public static function getPurchase($id): Purchase {
        return Purchase::find($id)->first();
    }

    public static function getSale(int $id): Purchase {
        return Sale::find($id)->get();
    }

    public static function getPurchases(User $user) {
        if($user->hasRole('admin')) {
            return Purchase::orderBy('created_at', 'desc')->paginate(25);
        } else {
            // Limit managers and staff to only their primary warehouse
            $warehouse = $user->warehouse();
            if($warehouse) {
                return Purchase::orderBy('created_at', 'desc')->where('warehouse_id', $warehouse->id)->paginate(25);
            }


            $collection = new Collection();
            // $currentPageItems = $collection->slice($offset, $perPage)->all();
            $paginator = new LengthAwarePaginator($collection, count($collection), 0, 1);
            // Set the path for the paginator
            $paginator->setPath(Request::url());
        
            return $paginator;

            // return collect([]);
            
        }
    }

    public static function getPurchasesByRange(User $user, $range) {
        $dateRange = explode('to', $range);
        $start = Carbon::parse($dateRange[0]);
        $end = Carbon::parse($dateRange[1]);
        if($user->hasRole('admin')) {
            return Purchase::whereBetween('created_at', [$start, $end])->orderBy('created_at', 'desc')->paginate(25);
        } else {
            // Limit managers and staff to only their primary warehouse
            $warehouse = $user->warehouse();
            if($warehouse) {
                return Purchase::whereBetween('created_at', [$start, $end])->orderBy('created_at', 'desc')->where('warehouse_id', $warehouse->id)->paginate(25);
            }

            return collect([]);
        }
    }

    public static function getPurchasesByInvoice(User $user, $invoice) {
        // dd($invoice);
        if($user->hasRole('admin')) {
            $result = Purchase::where("invoice_no", "LIKE", "%{$invoice}%")->get();
        } else {
            // Limit managers and staff to only their primary warehouse
            $warehouse = $user->warehouse();
            if($warehouse) {
                $result = Purchase::where('warehouse_id', $warehouse->id)
                ->where('invoice_no', 'LIKE', "%{$invoice}%")->get();
            } else {
                $result = new Collection();
            }
        }
        return $result;
    }

    public static function getSales(User $user) {
        if($user->hasRole('admin')) {
            return Sale::orderBy('created_at', 'desc')->paginate(25);
        } else {
            // Limit managers and staff to only their primary warehouse
            $warehouse = $user->warehouse();
            if($warehouse) {
                return Sale::orderBy('created_at', 'desc')->where('warehouse_id', $warehouse->id)->paginate(25);
            } else {
                $collection = new Collection();
                // $currentPageItems = $collection->slice($offset, $perPage)->all();
                $paginator = new LengthAwarePaginator($collection, count($collection), 0, 1);
                // Set the path for the paginator
                $paginator->setPath(Request::url());
            
                return $paginator;
            }
        }
    }

    public static function getSalesByRange(User $user, $range) {
        $dateRange = explode('to', $range);
        $start = Carbon::parse($dateRange[0]);
        $end = Carbon::parse($dateRange[1]);
        if($user->hasRole('admin')) {
            return Sale::whereBetween('created_at', [$start, $end])->orderBy('created_at', 'desc')->paginate(25);
        } else {
            // Limit managers and staff to only their primary warehouse
            $warehouse = $user->warehouse();

            if($warehouse) {
                return Sale::whereBetween('created_at', [$start, $end])->orderBy('created_at', 'desc')->where('warehouse_id', $warehouse->id)->paginate(25);
            } else {
                $collection = new Collection();
                // $currentPageItems = $collection->slice($offset, $perPage)->all();
                $paginator = new LengthAwarePaginator($collection, count($collection), 0, 1);
                // Set the path for the paginator
                $paginator->setPath(Request::url());
                return $paginator;
            }
        }
    }

    public static function getSalesByInvoice(User $user, $invoice) {
        // dd($invoice);
        if($user->hasRole('admin')) {
            $result = Sale::where("invoice_no", "LIKE", "%{$invoice}%")->get();
        } else {
            // Limit managers and staff to only their primary warehouse
            $warehouse = $user->warehouse();
            if($warehouse) {
                $result = Sale::where('warehouse_id', $warehouse->id)
                ->where('invoice_no', 'LIKE', "%{$invoice}%")->get();
            } else {
                $result = new Collection();
            }
        }
        return $result;
    }

    public static function warehouse(User $user) {
        if($user->hasRole('admin')) {
            return Warehouse::orderBy('created_at', 'desc')->paginate(25);
        } else {
            // Limit managers and staff to only their primary warehouse
            return $user->warehouse();
            // return Sale::orderBy('created_at', 'desc')->where('warehouse_id', $warehouse->id)->paginate(25);
        }
    }

    public static function returnPurchase(array $data, Purchase $purchase) {
        $receivable = floatval($data['total_price']) - floatval($data['discount_amount']);
        $return = PurchaseReturn::firstOrCreate([
            'purchase_id' => $purchase->id,
            'supplier_id' => $purchase->supplier_id],

            ['date' => Carbon::parse($data['date']),
            'total_price' => $data['total_price'],
            'discount' => $data['discount_amount'] ?? 0.00,
            'receivable' => $receivable,
            'notes' => $data['notes']
        ]);

        $orders =  json_decode($data['order']);

        foreach($orders as $order) {
            $products = ProductStock::where('product_id', $order->id)
            ->where('warehouse_id', $data['warehouse_id'])
            ->where('sold', false)->take($order->quantity)->get();
            // dd($products);

            $details = array_map(function($product) use ($return, $order) {
                return [
                    'product_id' => $order->id,
                    'serial' => $product->serial,
                    'price' => $order->price
                ];
            }, $products->all());

            // dd($details);

            $product_ids = array_map(function($product) {
                return $product->id;
            }, $products->all());
            $return->details()->createMany($details);
            // PurchaseReturnDetail::insert($details);
            ProductStock::whereIn('id', $product_ids)->delete();
        }
        return;
    }

    public static function returnedPurchases(int $id = null) {
        if($id != NULL) {
            $returns = PurchaseReturn::whereHas('owner');
        } else {
            $returns = PurchaseReturn::whereHas('owner', function ($query) use ($id) {
                $query->where('warehouse_id', $id);
            });
        }
        return $returns->paginate(25);
    }

    public static function returnedSales() {
        $returns = SaleReturn::whereHas('owner')->orderBy('created_at', 'desc')->paginate(25);
        return $returns;
    }

    public static function returnedSalesByWarehouse(int $id) {
        $returns = SaleReturn::whereHas('owner', function ($query) use ($id) {
            $query->where('warehouse_id', $id);
        })->paginate(25);
        return $returns;
    }

    public static function returnSale(array $data, Sale $sale) {
        $receivable = floatval($data['total_price']) - floatval($data['discount_amount']);
        $return = SaleReturn::firstOrCreate([
            'sale_id' => $sale->id,
            'customer_id' => $sale->customer_id],

            ['date' => Carbon::parse($data['date']),
            'total_price' => $data['total_price'],
            'discount' => $data['discount_amount'] ?? 0.00,
            'receivable' => $receivable,
            'notes' => $data['notes']
        ]);

        $orders =  json_decode($data['order']);

        foreach($orders as $order) {
            $products = ProductStock::where('product_id', $order->id)
            ->where('warehouse_id', $data['warehouse_id'])
            ->where('sold', true)->take($order->quantity)->get();

            $details = array_map(function($product) use ($return, $order) {
                return [
                    'return_id' => $return->id,
                    'product_id' => $order->id,
                    'serial' => $product->serial,
                    'price' => $order->price
                ];
            }, $products->all());
            // dd($details);
            $return->details()->createMany($details);

            $product_ids = array_map(function($product) {
                return $product->id;
            }, $products->all());

            ProductStock::whereIn('id', $product_ids)->update([
                'sold' => false,
                'sold_by' => null,
                'sold_from' => null
            ]);
        }
        return;
    }


    public static function updatePurchase(int $id, array $data) {
        $details = json_decode($data['order_details']);

        $status = strtolower($data['status']);
        
        if($status == 'received') {
            $purchase = Purchase::find($id);
            if($purchase != null) {
                $purchase->status = $status;
                $purchase->save();

                if($status == 'received' && count($details) > 0) {
                    event(new UpdatePurchaseEvent($id, $status, $details));
                }
            }
        }
    }

    public static function newInvoice() {
        $faker = Faker::create();
        $faker->addProvider(new Barcode($faker));
        return $faker->ean13(false);
    }

}