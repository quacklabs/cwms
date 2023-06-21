<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use App\Models\Warehouse;

class StoreController extends Controller
{
    public function stores(Request $request) {
        $stores = Store::orderBy('created_at', 'desc')->paginate(25);
        
        $data = [
            'title' => 'Stores',
            'stores' => $stores,
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
}
