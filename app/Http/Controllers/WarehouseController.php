<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 
use Spatie\Permission\Models\Role;
use App\Models\User;

class WarehouseController extends Controller {
    //

    public function index(Request $request) {
        if($request->method() == "POST") {
            $valid = $request->validate([
                'name' => ['required'],
                'address' => ['required']
            ]);
            Warehouse::create($valid);
            return redirect()->route('warehouse.all_warehouses')->with('success', 'Warehouse added successfully');
        }

        $data = [
            "title" => 'Warehouses',
            "warehouses" => Warehouse::orderBy('created_at', 'desc')->paginate(25),
            'user' => Auth::user()
        ];
        return parent::render($data, 'warehouse.warehouses');
    }

    public function toggle(Request $request) {
        $id = $request->route('id');
        $action = $request->route('action');
        if(!$id || !$action) {
            return redirect()->route('warehouse.all_warehouses');
        }
        $warehouse = Warehouse::find($id);

        if($warehouse == null) {
            return redirect()->route('warehouse.all_warehouses');
        }

        switch($action) {
            case 'activate':
                $warehouse->status = true;
                break;
            case 'suspend':
                $warehouse->status = false;
                break;
        }
        $warehouse->save();
        return redirect()->back();
    }

    public function edit(Request $request) {
        $id = $request->route('id');

        if(!$id) {
            return redirect()->back()->with('error', 'Warehouse could not be deleted, invalid ID');
        }
        $warehouse = Warehouse::find($id);
        if($warehouse == NULL) {
            return redirect()->back()->with('error', 'Warehouse already deleted');
        }

        $data = [
            "title" => 'Edit Warehouse',
            "warehouse" => $warehouse,
            'user' => Auth::user()
        ];

        if($request->method() == 'POST') {
            $details = $request->validate([
                'name' => ['required'],
                'address' => ['required']
            ]);

            $details['status'] = ($request->input('status') == 'on') ? true : false;
            $warehouse->update($details);
            return redirect()->route('warehouse.all_warehouses');
        }
        return parent::render($data, 'warehouse.edit_warehouse');
    }

    public function view(Request $request) {
        $id = $request->route('id');
        if(!$id) {
            return redirect()->route('warehouse.all_warehouses')->with('error', 'warehouse ID not found, please try again');
        }
        $warehouse = Warehouse::find($id);
        if(!$warehouse) {
            return redirect()->route('warehouse.all_warehouses')->with('error', 'Warehouse not found, please try again');
        }


        $data = [
            'title' => 'View Warehouse',
            'warehouse' => $warehouse
        ];

        return parent::render($data, 'warehouse.view_warehouse');
    }

    public function reassign(Request $request) {
        $id = $request->route('id');
        if(!$id) {
            return redirect()->back()->with('error', 'Warehouse could not be found, invalid ID');
        }
        $warehouse = Warehouse::find($id);
        if($warehouse == NULL) {
            return redirect()->back()->with('error', 'Warehouse already deleted');
        }
        $managerRole = Role::where('name', 'manager')->first();
        $data = [
            "title" => 'Reassign Warehouse',
            "warehouse" => $warehouse,
            'user' => Auth::user(),
            "managers" => User::role($managerRole)->paginate(100),
        ];

        if($request->method() == 'POST') {
            $details = $request->validate([
                'manager_id' => 'required'
            ]);
            $warehouse->update($details);
            return redirect()->route('warehouse.all_warehouses')->with('success', 'Warehouse reassigned successfully');
        }
        return parent::render($data, 'warehouse.reassign_warehouse');
    }

    public function delete(Request $request) {
        $id = $request->route('id');
        if(!$id) {
            return redirect()->back()->with('error', 'Warehouse could not be deleted, invalid ID');
        }
        $warehouse = Warehouse::find($id);
        if($warehouse == NULL) {
            return redirect()->back()->with('error', 'Warehouse already deleted');
        }

        $warehouse->delete();
        return redirect()->route('warehouse.all_warehouses')->with('success', 'Warehouse removed successfully');
    }
}
