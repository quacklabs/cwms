<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Adjustment;
use App\Models\AdjustmentDetail;
use App\Models\ProductStock;
use Faker\Factory as Faker;
use Carbon\Carbon;

use App\Models\Warehouse;

class StockController extends Controller {

    public function adjustments(Request $request) {
        $user = Auth::user();
        if(auth()->user()->hasRole('admin')) {
            $adjustments = Adjustment::orderBy('created_at', 'desc')->paginate(50);
            // $warehouses = 
        } else {
            $warehouse = $user->warehouse->first();
            $adjustments = Adjustment::orderBy('created_at', 'desc')->where('warehouse_id', $warehouse->id)->paginate(50);
        }

        $data = [
            'title' => 'Stock Adjustments',
            'adjustments' => $adjustments,
            // 'warehouses' => $warehouses ,
        ];

        return parent::render($data, 'product.adjustments');
    }

    public function make_adjustment(Request $request) {

        if($request->method() == 'POST') {
            $valid = $request->validate([
                'warehouse_id' => ['required', 'numeric'],
                'adjust_date' => ['required', 'date'],
                'notes' => ['nullable', 'string'],
                'items' => ['required']
            ]);

            $adjustment = $this->store($valid);
            if($adjustment) {
                return redirect()->route('stock.adjustments')->with('success','Adjustment added successfully');
            }
        }

        if(auth()->user()->hasRole('admin')) {
            $warehouses = Warehouse::orderBy('created_at', 'desc')->paginate(65);
        } else {
            $warehouses = auth()->user()->warehouse->first();
        }

        $data = [
            'title' => 'Adjust Stock',
            'warehouses' => $warehouses
        ];

        return parent::render($data, 'product.make_adjustment');
    }

    public function delete_adjustment(Request $request) {
        $id = $request->route('id');

        return redirect()->route('stock.adjustments');

        // if(!$id) {
        //     return redirect()->route('stock.adjustments');
        // }

        // $adjustment = 
    }


    private function store($data) {
        $faker = Faker::create();
        $adjustment = Adjustment::create([
            'warehouse_id' => $data['warehouse_id'],
            'adjust_date' => Carbon::parse($data['adjust_date']),
            'tracking_no' => $faker->bothify("???########"),
        ]);

        if($data['notes']) {
            $adjustment->note = $data['notes'];
        }

        $orders = array_map(function($order) {
            return [
                'product_id' => $order->product_id,
                'quantity' => $order->quantity,
                'adjust_type' => $order->adjust_type
            ];
        }, json_decode($data['items']));
        $adjustment->details()->createMany($orders);

        foreach($orders as $order) {
            $product_stock = ProductStock::where('warehouse_id', $adjustment->warehouse_id)->where('product_id', $order['product_id'])->first();;
            if($product_stock) {
                switch($order['adjust_type']) {
                    case 1:
                        $product_stock->quantity = $product_stock->quantity - $order['quantity'];
                        break;
                    case 2:
                        $product_stock->quantity = $product_stock->quantity + $order['quantity'];
                        break;
                }
                $product_stock->save();
            }
        }

        return $adjustment;
    }
}
