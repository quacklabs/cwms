<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Adjustment;


class StockController extends Controller {
    

    public function adjustments(Request $request) {
        $user = Auth::user();

        if($user->hasRole('admin')) {
            $adjustments = Adjustment::orderBy('created_at', 'desc')->paginate(50);
        } else {
            $warehouse = $user->warehouse->first();
            $adjustments = Adjustment::orderBy('created_at', 'desc')->where('warehouse_id', $warehouse->id)->paginate(50);
        }

        $data = [
            'title' => 'Stock Adjustments',
            'adjustments' => $adjustments
        ];

        return parent::render($data, 'product.adjustments');
    }

    public function make_adjustment(Request $request) {


        $data = [
            'title' => 'Adjust Stock'
        ];

        return parent::render($data, 'product.make_adjustment');
    }
}
