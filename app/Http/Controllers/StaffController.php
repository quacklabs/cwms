<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    //

    public function staff() {

    }

    public function manager() {
        $data = [
            "title" => "Managers",
        ];
        // dd($breadcrumbs);
       
        return $this->render($data, 'staff/managers');
    }

    private function render(array $data, string $page) {
        // you can add other data to be used on admin before rendering
        
        return view($page, $data);
    }
}
