<?php

namespace App\Http\Controllers;
// session_start();

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\Warehouse;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Product;
// use App\Models\ProductStock;
use App\Models\User;
use App\Contracts\ProductResponse;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MyDataImport;
use App\Services\StockManager as StockService;
use App\Models\Store;

use Pusher\PushNotifications\PushNotifications;


class APIController extends Controller
{
    protected $middlewareGroups = 'api';
    
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

    public function products(Request $request) {
        $search = $request->input('query');
        $user_id = $request->input('user');

        $response = [];
        if(!$search || !$user_id){
            $response['status'] = false;
            $response['data'] = null;
        }
        $products = Product::where('name', 'LIKE', '%' . $search . '%')
        ->orWhere('sku', 'LIKE', '%' . $search . '%')
        ->get();
        $user = User::find($user_id);
        if(!$user) {
            $response['status'] = false;
            $response['data'] = null;
            return response()->json($response);
        }
        
        if($products != null) {
            // dd($products->all());
            $response['status'] = true;
            $response['data'] = array_map(function($product) use($user) {
                // dd($product->id);

                return new ProductResponse($product->id, $product->name, $product->totalInStock($user));
            }, $products->all());

            // dd($response);
        } else {
            $response['status'] = false;
            $response['data'] = [];
        }
        return response()->json($response);

    }


    public function productsInGIT(Request $request) {
        $search = $request->input('query');
        $user_id = $request->input('user');

        $response = [];
        if(!$search || !$user_id){
            $response['status'] = false;
            $response['data'] = null;
            return response()->json($response);
        }
        $products = Product::where('name', 'LIKE', '%' . $search . '%')
        ->orWhere('sku', 'LIKE', '%' . $search . '%')
        ->get();
        $user = User::find($user_id);
        if(!$user) {
            $response['status'] = false;
            $response['data'] = null;
            return response()->json($response);
        }
        
        if($products != null) {
            $response['status'] = true;
            $response['data'] = array_map(function($product) use($user) {
                return new ProductResponse($product->id, $product->name, $product->gitStock($user));
            }, $products->all());

        } else {
            $response['status'] = false;
            $response['data'] = [];
        }
        return response()->json($response);

    }

    public function productsbyWarehouse(Request $request) {
        $keyword = $request->input('query');
        $id = $request->route('id');
        $response = [];
        if(!$keyword || !$id){
            $response['status'] = false;
            $response['data'] = null;
            return response()->json($response);
        }
        $stock = StockService::searchByWarehouse($id, $keyword);

        if($stock != null) {
            // dd($products->all());
            $response['status'] = true;
            $response['data'] = array_map(function($detail) {
                return new ProductResponse($detail['product']->id, $detail['product']->name, $detail['stock']);
            }, $stock->all());
    
        } else {
            $response['status'] = false;
            $response['data'] = [];
        }
        return response()->json($response);
    }

    public function findProductInWarehouse(Request $request) {
        $warehouse_id = $request->input('warehouse_id');
        $query = $request->input('query');
        $response = [];
        if(!$warehouse_id || !$query){
            $response['status'] = false;
            $response['data'] = null;
            return response()->json($response);
        }

        $stock = StockService::searchByWarehouse($warehouse_id, $query);
        if($stock != null) {
            $response['status'] = true;
            $response['data'] = array_map(function($detail) {
                return new ProductResponse($detail['product']->id, $detail['product']->name, $detail['stock']);
            }, $stock->all());
    
        } else {
            $response['status'] = false;
            $response['data'] = [];
        }
        return response()->json($response);
    }

    public function warehouses(Request $request) {
        $search = $request->input('query');
        $response = [];
        if(!$search){
            $response['status'] = false;
            $response['data'] = null;
            return response()->json($response)->header('Content-Type', 'application/json');
        }
        $warehouses = Warehouse::where('name', 'LIKE', '%' . $search . '%')
        ->orWhere('address', 'LIKE', '%' . $search . '%')
        ->get();
        $response['status'] = true;
        $response['data'] = $warehouses;
        return response()->json($response)->header('Content-Type', 'application/json');
    }

    public function partners(Request $request) {
        $search = $request->input('query');
        $flag = $request->route('flag');
        $response = [];
        if(!$search || !$flag) {
            $response['status'] = false;
            $response['data'] = null;
            return response()->json($response)->header('Content-Type', 'application/json');
        }
        switch($flag) {
            case 'customer':
                $data = Customer::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $search . '%')
                ->get();
                break;
            case 'supplier':
                $data = Supplier::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $search . '%')
                ->get();
        }
        $response['status'] = true;
        $response['data'] = $data ?? null;
        return response()->json($response)->header('Content-Type', 'application/json');
    }

    public function parse_serials(Request $request) {
        $file = $request->file('file');

        if ($file->isValid()) {
            $filePath = $file->getRealPath();
            $fileType = $file->getClientOriginalExtension();

            if ($fileType === 'csv') {
                $csv = Reader::createFromPath($filePath);
                $csv->setHeaderOffset(0); // Skip the header row if present
    
                // Convert CSV rows to an array
                $data = iterator_to_array($csv->getRecords());
                
                $parsedData = array_map(function($row) {
                    return $row;
                }, $data); // Assuming the data is in the first sheet
                $response = [
                    'status' => true,
                    'data' => $parsedData
                ];
                $response = [
                    'status' => true,
                    'data' => array_values($parsedData)
                ];
                // Process the array as needed
                // ...
            } elseif ($fileType === 'xls' || $fileType === 'xlsx') {
                try {
                    // Parse the XLS file using the Excel facade
                    $data = Excel::toArray(new MyDataImport(), $filePath);
    
                    // Access the parsed data
                    $parsedData = array_map(function($row) {
                        return $row;
                    }, array_value($data[0])) ; // Assuming the data is in the first sheet
                    $response = [
                        'status' => true,
                        'data' => $parsedData
                    ];
                    // Process the parsed data as needed
                    // ...
                } catch (\Exception $e) {
                    $response = [
                        'status' => false,
                        'data' => null
                    ];
                }
            }
        } else {
            $response = [
                'status' => false,
                'data' => 'file is not valid'
            ];
        }

        return response()->json($response)->header('Content-Type', 'application/json');
    }


    public function stores(Request $request) {
        $search = $request->input('query');
        $response = [];
        if(!$search){
            $response['status'] = false;
            $response['data'] = null;
            return response()->json($response)->header('Content-Type', 'application/json');
        }
        $warehouses = Store::where('name', 'LIKE', '%' . $search . '%')
        ->orWhere('address', 'LIKE', '%' . $search . '%')
        ->get();
        $response['status'] = true;
        $response['data'] = $warehouses;
        return response()->json($response)->header('Content-Type', 'application/json');
    }

    public function activeJobs(Request $request) {
        $response = [

        ];

        $id = $request->route('id');
        if(!$id){
            return response()->json(["message" => "Unauthorized"], 400);
        }
        

        return response()->json(["message" => "Pluto is active"], 200);
    }

    public function pendingJobs(Request $request) {
        $id = $request->route('id');
        if(!$id){
            return response()->json(["message" => "Unauthorized"], 400);
        }
        $user = User::find($id)->firstOrFail();
        if($user) {
            return response()->json(["message" => $user->pendingJobs->count()], 200);
        }
        
    }

    public function registerForPush(Request $request) {
        $id = $request->route('user_id');
        $user = User::find($id);
        if($user) {
            $pusher = new PushNotifications(
                array(
                  "instanceId" => env('BEAM_INSTANCE_ID'),
                  "secretKey" => env('BEAM_SECRET_KEY'),
                )
            );
            $beamsToken = $pusher->generateToken("$user->id");
            return response()->json($beamsToken);
        } else{
            return response()->json(['status' => false]);
        }


        // $userIDInQueryParam = Input::get('user_id');
        
    
        // if ($userID != $userIDInQueryParam) {
        //     return response('Inconsistent request', 401);
        // } else {
        //     // $beamsToken = $beamsClient->generateToken($userID);
        //     return response()->json($beamsToken);
        // }
    }

    public function testNotifications(Request $request) {
        $pusher = new PushNotifications(
            array(
              "instanceId" => env('BEAM_INSTANCE_ID'),
              "secretKey" => env('BEAM_SECRET_KEY'),
            )
        );

        $response = $pusher->publishToUsers(
            array("1"),
            array(
              "web" => array(
                "data" => array(
                  "title" => "Hi!",
                  "body" => "This is my first Push Notification!"
                )
              )
          ));
          return response()->json($response, 200);
    }
}
