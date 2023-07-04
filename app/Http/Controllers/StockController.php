<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Adjustment;
use App\Models\AdjustmentDetail;
use App\Models\ProductStock;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Services\StockService;

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

            $adjustment = StockService::store_adjustment($valid);
            if($adjustment) {
                return redirect()->route('stock.adjustments')->with('success','Adjustment added successfully');
            }
        }

        if(auth()->user()->hasRole('admin')) {
            $warehouses = Warehouse::orderBy('created_at', 'desc')->paginate(65);
        } else {
            $warehouses = auth()->user()->warehouse;
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
}
