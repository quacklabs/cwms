<?php
namespace App\Http\Helpers;

use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Warehouse;
use App\Models\User;
use App\Models\Item;
use App\Model\SaleItem;
use App\Models\ProductStock;
use Spatie\Permission\Models\Role;
use App\Contracts\TransactionInterface;
use Carbon\Carbon;

final class Transaction implements TransactionInterface {

    public static function create(array $data, $flag): TransactionInterface {
        switch($flag) {
            case 'sale':
                $transaction = Sale::create([
                    'customer_id' => $data['partner_id'],
                    'invoice_no' => $data['invoice_no'],
                    'warehouse_id' => $data['warehouse_id'],
                    'total_price' => $data['total_price'],
                    'discount_amount' => $data['discount_amount'],
                    'date' => Carbon::parse($data['date'])
                ]);
                break;
            case 'purchase':
                $transaction = Purchase::create([
                    'supplier_id' => $data['partner_id'],
                    'invoice_no' => $data['invoice_no'],
                    'warehouse_id' => $data['warehouse_id'],
                    'total_price' => $data['total_price'],
                    'discount_amount' => $data['discount_amount'],
                    'date' => Carbon::parse($data['date'])
                ]);
                break;
            default:
                return null;
        }
        $orders = array_map(function($order) {
            return [
                'product_id' => $order->id,
                'quantity' => $order->quantity,
                'price' => $order->price,
                'total' => $order->total_price, 
                'serials' => $order->serials ?? []
            ];
        }, json_decode($data['order']));
        // dd($orders);
        $transaction->details()->createMany($orders);
        
        if($flag == 'purchase') {
            foreach($orders as $order) {
                $stock = ProductStock::where('warehouse_id', $data['warehouse_id'])
                ->where('product_id', $order['product_id'])->first();
                if($stock) {
                    $stock->quantity = $stock->quantity + $order['quantity'];
                    $stock->save();
                } else {
                    $stock = ProductStock::create([
                        'warehouse_id' => $data['warehouse_id'],
                        'product_id' => $order['product_id'],
                        'quantity' => $order['quantity']
                    ]);
                }
                $serials = json_decode($order['serials']);


                if(count($serials) > 0) {
                    foreach($serials as $serial) {
                        Item::create([
                            'product_id' => $order['product_id'],
                            'purchase_id' => $transaction->id,
                            'serial_no' => $serial,
                            'current_warehouse' => $data['warehouse_id']
                        ]);
                    }
                }
            }
        } else {

            foreach($orders as $order) {
                $stock = ProductStock::where('warehouse_id', $data['warehouse_id'])
                ->where('product_id', $order['product_id'])->first();
                // $stock->quantity = $stock->quantity - $order['quantity'];

                if($stock->quantity < $order['quantity']){
                    $transaction->total_price = $transaction->total->price - $order['total_price'];
                    $transaction->save();
                    
                } else {
                    $stock->quantity = $stock->quantity - $order['quantity'];
                    $stock->save();

                    $serials = json_decode($order['serials']);

                    if(count($serials) > 0) {
                        foreach($serials as $serial) {
                            $item = Item::where('product_id', $order['product_id'])
                            ->where('current_warehouse', $data['warehouse_id'])
                            ->where('serial_no', $serial)->first();
                            $item->sold = true;
                            $item->save();

                            SaleItem::create([
                                'product_id' => $order['product_id'],
                                'sale_id' => $transaction->id,
                                'serial_no' => $serial,
                                'sale_warehouse' => $data['warehouse_id']
                            ]);
                        }
                    }
                }
            }
        }
        return $transaction;
    }

    public static function getPurchases(User $user) {
        if($user->hasRole('admin')) {
            return Purchase::orderBy('created_at', 'desc')->paginate(25);
        } else {
            // Limit managers and staff to only their primary warehouse
            $warehouse = $user->warehouse->first();
            return Purchase::orderBy('created_at', 'desc')->where('warehouse_id', $warehouse->id)->paginate(25);
        }
    }

    public static function getSales(User $user) {
        if($user->hasRole('admin')) {
            return Purchase::orderBy('created_at', 'desc')->paginate(25);
        } else {
            // Limit managers and staff to only their primary warehouse
            $warehouse = $user->warehouse->first();
            return Sale::orderBy('created_at', 'desc')->where('warehouse_id', $warehouse->id)->paginate(25);
        }
    }

    public static function warehouse(User $user) {
        if($user->hasRole('admin')) {
            return Warehouse::orderBy('created_at', 'desc')->paginate(25);
        } else {
            // Limit managers and staff to only their primary warehouse
            return $user->warehouse->all();
            // return Sale::orderBy('created_at', 'desc')->where('warehouse_id', $warehouse->id)->paginate(25);
        }
    }

    public static function purchase(int $id): Purchase {
        return Purchase::findOrFail($id);
    }
    public static function sale(int $id): Sale {
        return Sale::findOrFail($id);
    }
    public function payable(): float {

    }
    public function due(): float {

    }
}