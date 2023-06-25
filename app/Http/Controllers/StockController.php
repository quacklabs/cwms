<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;


class StockController extends Controller {
    

    public function adjust(Request $request) {

        $data = [
            'title' => 'Stock Adjustments'
        ];


        return parent::render($data, 'product.adjustments');
    }
}
