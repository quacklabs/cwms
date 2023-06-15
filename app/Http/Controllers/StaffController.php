<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
    //

    public function staff() {
        $staffRole = Role::where('name', 'staff')->first();
        $data = [
            "title" => "Manage Staff",
            "managers" => User::role($staffRole)->paginate(30)
        ];
        // dd($breadcrumbs);
       
        return $this->render($data, 'staff/staff');

    }

    public function manager(Request $request) {
        $managerRole = Role::where('name', 'manager')->first();
        $data = [
            "title" => "Managers",
            "managers" => User::role($managerRole)->paginate(30)
        ];
        if($request->method() == "POST") {

        }
        return $this->render($data, 'staff/managers');
    }

    private function render(array $data, string $page) {
        // you can add other data to be used on admin before rendering
        
        return view($page, $data);
    }
}
