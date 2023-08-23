<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Warehouse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{

    public function staff(Request $request) {
        $staffRole = Role::findByName('staff');
        
        if($request->method() == "POST") {
            $rules = [
                'name' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'username' => ['required', 'string', 'unique:users'],
                'mobile' => ['required', 'numeric', 'unique:users'],
                'assigned_to' => ['nullable']
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $form_data =  $validator->validated();
            $user = User::create([
                'name' => $form_data['name'],
                'email' => $form_data['email'],
                'password' => $form_data['password'],
                'username' => $form_data['username'],
                'mobile' => $form_data['mobile']]);
                
            $user->assignRole($staffRole);
            $user->save();
            return redirect()->route('staff.managers')->with('success', 'Staff Added Successfully');
        }  
        $data = [
            "title" => "Manage Staff",
            "staffs" => User::role($staffRole)->paginate(30),
            "warehouses" => Warehouse::all()
        ];     
        return parent::render($data, 'staff/staff');
    }

    public function manager(Request $request) {
        $managerRole = Role::findByName('manager');
        
        if($request->method() == "POST") {
            $rules = [
                'name' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'username' => ['required', 'string', 'unique:users'],
                'mobile' => ['required', 'numeric', 'unique:users'],
                'assigned_to' => ['nullable']
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $form_data =  $validator->validated();
            $user = User::create([
                'name' => $form_data['name'],
                'email' => $form_data['email'],
                'password' => $form_data['password'],
                'username' => $form_data['username'],
                'mobile' => $form_data['mobile']]);
                
            $user->assignRole($managerRole);
            $warehouse_id = $form_data['assigned_to'] ?? null;
            
            if(isset($warehouse_id) && $warehouse_id != '' && $warehouse_id != NULL) {

                $warehouse = Warehouse::find('id', $warehouse_id)->get()->first();
                    
                if($warehouse){
                    $user->warehouse_id = $warehouse->id;
                    $warehouse->manager_id = $user->id;
                    $warehouse->save();
                }
            }
            $user->save();
            return redirect()->route('staff.managers')->with('success', 'Staff Added Successfully');
        }
        $data = [
            "title" => "Managers",
            "managers" => User::role($managerRole)->paginate(30),
            "warehouses" => Warehouse::all()
        ];
        return parent::render($data, 'staff/managers');
    }

    public function edit_user(Request $request) {
        $id = $request->route('id');
        $action = $request->route('action');

        if($id != null) {
            $user = User::find($id);

            if($user) {
                $data = [
                    "title" => "Edit ".$user->name,
                    "manager" => $user,
                    'warehouses' => Warehouse::all()
                ];

                if($request->method() == "POST") {
                    return $this->edit_profile($request, $user);
                }   
        
                return $this->render($data, 'staff/edit_user');
            }
        }

        return redirect()->route('staff.managers');
    }

    protected function create_user(Request $request, Role $role) {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'username' => ['required', 'string', 'unique:users'],
            'mobile' => ['required', 'numeric', 'unique:users'],
            'assigned_to' => ['numeric', 'nullable']
        ]);

        // dd($data);

        $user_info = $request->only();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'username' => $data['username'],
            'mobile' => $data['mobile']]);

        $user->assignRole($role);
        
        if(isset($data['assigned_to']) && $data['assigned_to'] != '') {
            $warehouse = Warehouse::find('id', $data['assigned_to'])->get()->first();
                        
            if($warehouse){
                $user->warehouse_id = $warehouse->id;
                // $user->save();
                if($user->hasRole('manager')) {
                    $warehouse->manager_id = $user->id;
                    $warehouse->save();
                }
            }
        }
        $user->save();
        return redirect()->route('staff.managers')->with('success', 'Staff Added Successfully');
    }

    protected function edit_profile(Request $request, User $user) {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'nullable'],
            'username' => ['required', 'string'],
            'mobile' => ['required', 'numeric'],
            'assigned_to' => ['numeric', 'required']
        ]);

        $user_info = $request->only(['name', 'email', 'password','username','mobile']);
        foreach($user_info as $key => $value) {
            if($value != NULL && $value != '') {
                $user->$key = $value;
            }
            
        }

        if(isset($data['assigned_to']) && $data['assigned_to'] != '') {
            $user->warehouse_id = $data['assigned_to'];
        }
        $user->save();
        return redirect()->route('staff.managers')->with('success', 'Staff modified successfully');
    }

    public function toggle(Request $request) {
        $id = $request->route('id');
        $action = $request->route('action');

        if($id && $action) {
            $user = User::find($id);
            if($user) {
                switch($action) {
                    case 'activate':
                        $user->status = true;
                        break;
                    case 'suspend':
                        $user->status = false;
                        break;
                }
                $user->save();
                return redirect()->back()->with('success', 'Account modified');
            }
        }

        return redirect()->route('dashboard');
    }

    public function delete_user(Request $request) {
        $id = $request->route('id');
        if($id) {
            $user = Auth::user();
            if($user->can('delete-account')) {
                $account = User::find($id);
                if($account) {
                    $account->delete();
                }
            }
        }

        return redirect()->route('staff.staff');
    }

    // private function render(array $data, string $page) {
    //     // you can add other data to be used on admin before rendering
        
    //     return view($page, $data);
    // }
}
