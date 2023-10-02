<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\StockManager as Manager;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\Store;
use App\Services\TransferService;


class GoodsInTransitController extends Controller {

    public function view(Request $request) {
        $stock = Manager::getInTransit();
        $data = [
            'title' => 'Goods In Transit',
            'product_stock' => $stock,
            'user' => Auth::user()
        ];
        return parent::render($data, 'transit.view');
    }

    public function viewByWarehouse(Request $request) {
        $user = Auth::user();
        $id = $request->route('warehouse');
        if($id == 0) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to perform this action');
        }
        $stock = Manager::getInTransitByWarehouse($id);
        $data = [
            'title' => 'View Goods in Transit',
            'product_stock' => $stock,
            'byWarehouse' => true,
        ];
        return parent::render($data, 'transit.view');
    }

    public function transfer(Request $request) {
        $product_id = $request->route('product');
        if(!$product_id) {
            return redirect()->route('transit.view');
        }
        $product = Product::find($product_id);

        $data = [
            "title" => 'Transfer from GIT Warehouse',
            "flag" => 'git',
            "to_warehouse" => Warehouse::orderBy('name', 'asc')->paginate(50),
            "to_store" => Store::orderBy('name', 'asc')->paginate(50),
            "product" => $product
        ];
        return parent::render($data, 'transit.transfer');
    }

    public function makeTransfer(Request $request) {
        $destination = $request->route('destination');
        
        $validate = Validator::make($request->all(), [
            'from' => ['nullable', 'numeric'],
            'to' => ['required', 'numeric'],
            'notes' => ['nullable', 'string'],
            'items' => ['required'],
            'transfer_date' => ['required', 'date']
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        } else {
            TransferService::createTransfer($validate->validated(), 'git', $destination);
            return redirect()->route('transit.view')->with('success', 'Stock is queued for transfer successfully.');
        }
    }

    public function receive_goods(Request $request) {
        $destination = $request->route('id');
        $validate = Validator::make($request->all(), [
            'order_details' => ['required'],
            'sent' => ['required'],
            'received' => ['required']
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        } else {
            // dd($validate->validated());
            TransferService::receiveGoods($validate->validated(), $destination);
            return redirect()->route('transit.view')->with('success', 'Stock Transfered Successfuly');
        }
        
    }
}
