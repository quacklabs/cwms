<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use App\Models\Warehouse;

class StoreController extends Controller
{
    public function stores(Request $request) {

        $user = Auth::user();

        if($request->method() == 'POST') {
            $valid = $request->validate([
                'name' => ['required'],
                'address' => ['required'],
                'notes' => ['nullable'],
                'warehouse_id' => ['required']
            ]);
            Store::create($valid);
            return redirect()->route('store.stores')->with('success', 'Store Added successfully');
        }

        if($user->hasRole('admin')) {
            $stores = Store::orderBy('created_at', 'desc')->paginate(25);
            $warehouses = Warehouse::orderBy('created_at', 'desc')->paginate(50);
        } else {
            if($user->warehouse_id == NULL) {
                return redirect()->route('dashboard')->with('error', 'You are not assigned to a warehouse');
            } 
            $stores = Store::where('warehouse_id', $user->warehouse_id)->orderBy('created_at', 'desc')->paginate(25);
            $warehouses = Warehouse::where('manager_id', $user->warehouse_id)->orderBy('created_at', 'desc')->paginate(50);
        }


        
        $data = [
            'title' => 'Stores',
            'stores' => $stores,
            'warehouses' => $warehouses
        ];
        return parent::render($data, 'store.stores');
    }

    public function edit(Request $request) {
        $id = $request->route('id');

        if(!$id) {
            return redirect()->back()->with('error', 'Store could not be edited, invalid ID');
        }
        $store = Store::find($id);
        if($store == NULL) {
            return redirect()->back()->with('error', 'Store already deleted');
        }
        $warehouses = Warehouse::orderBy('created_at', 'desc')->get();

        $data = [
            "title" => 'Edit Store',
            "store" => $store,
            'warehouses' => $warehouses,
            'user' => Auth::user()
        ];

        if($request->method() == 'POST') {
            $details = $request->validate([
                'name' => ['required'],
                'address' => ['required'],
                'warehouse_id' => ['nullable'],
            ]);

            $details['status'] = ($request->input('status') == 'on') ? true : false;
            $store->update($details);
            return redirect()->route('store.stores')->with('success', 'Store details modified');
        }
        return parent::render($data, 'store.edit_store');
    }

    public function toggle(Request $request) {
        $id = $request->route('id');
        $action = $request->route('action');
        if(!$id || !$action) {
            return redirect()->route('store.stores');
        }
        $store = Store::find($id);

        if($store == null) {
            return redirect()->route('store.stores');
        }

        switch($action) {
            case 'activate':
                $store->status = true;
                break;
            case 'suspend':
                $store->status = false;
                break;
        }
        $store->save();
        return redirect()->back();
    }

    public function delete(Request $request) {
        $id = $request->route('id');
        if(!$id) {
            return redirect()->back()->with('error', 'Store could not be deleted, invalid ID');
        }
        $store = Store::find($id);
        if($store == NULL) {
            return redirect()->back()->with('error', 'Store already deleted');
        }
        $store->delete();
        return redirect()->route('store.all_stores')->with('success', 'Store removed successfully');
    }

    public function view_inventory(Request $request) {

    }

    public function view_analytics(Request $request) {
        
    }
}
