<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller {
    //

    public function index(Request $request) {

        $data = [
            "title" => "Dashboard"
        ];

        return parent::render($data, 'dashboard');

    }
    // private function render(array $data, string $page) {
    //     // you can add other data to be used on admin before rendering
    //     return view($page, $data);
    // }
}
