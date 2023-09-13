<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function render(array $data, string $page) {
        // you can add other data to be used on admin before rendering
        $data['api_token'] = session('api_token') ?? '';
        $data['x_token'] = csrf_token();
        $data['user'] = Auth::user();
        return view($page)->with($data);
    }

}


