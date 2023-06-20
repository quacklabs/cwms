<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class APIController extends Controller
{
    
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
}
