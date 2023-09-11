<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\StockManager as Manager;

class GoodsInTransitController extends Controller
{
    //

    public function view(Request $request) {
        $stock = Manager::getInTransit();
        $data = [
            'title' => 'Goods In Transit',
            'product_stock' => $stock,
            'user' => Auth::user()
        ];
        return parent::render($data, 'transit.view');
    }
}
