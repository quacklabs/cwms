<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;

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
        return parent::render($data, 'warehouses');
    }
}
