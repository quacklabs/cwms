<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Warehouse;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\ProductStock;
use App\Contracts\ProductResponse;

class APIController extends Controller
{
    protected $middlewareGroups = 'api';
    
    public function managers(Request $request) {
        $search = $request->input('search');
        $response = [];
        if(!$id){
            $response['status'] = false;
            $response['data'] = null;
        }
        $managerRole = Role::where('name', 'manager')->first();
        
        $managers = User::role($managerRole)->where('name', 'like', "%$search%")->get();
        if(!$managers) {
            $response['status'] = false;
            $response['data'] = null;
        } else {
            $response['status'] = true;
            $response['data'] = $managers;
        }
        return response()->json($response);

    }

    public function products(Request $request) {
        $search = $request->input('query');
        $response = [];
        if(!$search){
            $response['status'] = false;
            $response['data'] = null;
        }
        $products = Product::where('name', 'LIKE', '%' . $search . '%')
        ->orWhere('sku', 'LIKE', '%' . $search . '%')
        ->get();
        if($products != null) {
            // dd($products->all());
            $response['status'] = true;
            $response['data'] = array_map(function($product) {
                // dd($product->id);
                return new ProductResponse($product->id, $product->name, $product->totalInStock());
            }, $products->all());

            // dd($response);
        } else {
            $response['status'] = false;
            $response['data'] = [];
        }
        return response()->json($response);

    }

    public function productsbyWarehouse(Request $request) {
        $keyword = $request->input('query');
        $id = $request->route('id');
        $response = [];
        if(!$keyword || !$id){
            $response['status'] = false;
            $response['data'] = null;
        }
        $stock = ProductStock::with('product')->where('warehouse_id', $id)
        ->whereHas('product', function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')->orWhere('sku', 'LIKE', '%' . $keyword . '%');
        })->get();

        // dd($products);
        if($stock != null) {
            // dd($products->all());
            $response['status'] = true;
            $response['data'] = array_map(function($detail) {
                // dd($product->id);
                return new ProductResponse($detail->product_id, $detail->product->name, $detail->quantity);
            }, $stock->all());

            // dd($response);
        } else {
            $response['status'] = false;
            $response['data'] = [];
        }
        return response()->json($response);

    }

    public function warehouses(Request $request) {
        $search = $request->input('query');
        $response = [];
        if(!$search){
            $response['status'] = false;
            $response['data'] = null;
            return response()->json($response)->header('Content-Type', 'application/json');
        }
        $warehouses = Warehouse::where('name', 'LIKE', '%' . $search . '%')
        ->orWhere('address', 'LIKE', '%' . $search . '%')
        ->get();
        $response['status'] = true;
        $response['data'] = $warehouses;
        return response()->json($response)->header('Content-Type', 'application/json');
    }

    public function partners(Request $request) {
        $search = $request->input('query');
        $flag = $request->route('flag');
        $response = [];
        if(!$search || !$flag) {
            $response['status'] = false;
            $response['data'] = null;
            return response()->json($response)->header('Content-Type', 'application/json');
        }
        switch($flag) {
            case 'customer':
                $data = Customer::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $search . '%')
                ->get();
                break;
            case 'supplier':
                $data = Supplier::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $search . '%')
                ->get();
        }
        $response['status'] = true;
        $response['data'] = $data ?? null;
        return response()->json($response)->header('Content-Type', 'application/json');
    }
}
