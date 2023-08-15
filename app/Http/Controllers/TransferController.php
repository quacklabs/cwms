<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\TransferService;
use App\Models\Warehouse;
use App\Models\Store;

class TransferController extends Controller {

    public function transfers(Request $request) {
        
        $flag = $request->route('flag');
        if(!isset($flag)) {
            return redirect()->route('transfer.view', ['flag' => 'warehouse']);
        }

        switch($flag) {
            case 'warehouse':
                $transfers = $this->getWarehouseTransfers();
                break;
            case 'stores':
                $transfers = $this->getStoreTransfers();
                break;
            default:
                $transfers = $this->getWarehouseTransfers();
                break;
        }

        $data = [
            'title' => 'Transfers',
            'transfers' => $transfers,
            'flag' => $flag
        ];

        return parent::render($data, 'transfer.transfers');
    }

    private function getWarehouseTransfers() {
        $user = Auth::user();
        if($user->hasRole('admin')) {
            $transfers = TransferService::getAllPaginated();
        } else {
            if($user->warehouse() == null) {
                return collect([]);
            }
            $id = $user->warehouse()->id;
            $transfers = TransferService::getByWarehouse($id);
        }
        return $transfers;
    }

    private function getStoreTransfers(int $id) {
        $user = Auth::user();
        if($user->hasRole('admin')) {
            $transfers = TransferService::getAllPaginated();
        } else {
            if($user->warehouse() == null) {
                return collect([]);
            }
            $id = $user->warehouse()->id;
            $transfers = TransferService::getByStore($id);
        }
        return $transfers;
    }

    public function create_transfer(Request $request) {
        $user = Auth::user();
        $flag = $request->route('flag');

        if(!isset($flag)) {
            return redirect()->route('transfer.view', ['flag' => 'warehouse']);
        }

        $data = [
            'title' => 'Make Transfer',
            'flag' => $flag
        ];

        switch($flag) {
            case 'warehouse':
                return $this->warehouse_transfer($data);
                break;
            case 'store':
                return $this->store_transfer($data);
                break;
            default:
                return redirect()->route('transfer.view', ['flag' => 'warehouse']);
                break;

        }
    }

    public function makeTransfer(Request $request) {
        $destination = $request->route('destination');
        $flag = $request->route('flag');

        $valid = $request->validate([
            'from' => ['required', 'numeric'],
            'to' => ['required', 'numeric'],
            'notes' => ['nullable', 'string'],
            'items' => ['required'],
            'transfer_date' => ['required', 'date']
        ]);
        TransferService::createTransfer($valid, $flag, $destination);
        return redirect()->route('transfer.view', ['flag' => $flag])->with('success', 'Transfer processed successfully');
    }

    private function store_warehouse(array $data) {
        $from = Store::orderBy('created_at', 'desc')->paginate(60);
        $to = Store::orderBy('created_at', 'desc')->paginate(60);
        $data['from'] = $from;
        $data['to'] = $to;
        return parent::render($data, 'transfer.add_store_transfer');
    }

    private function warehouse_transfer(array $data) {
        $user = Auth::user();
        if($user->hasRole('admin')) {
            $data['my_warehouse'] = Warehouse::orderBy('created_at', 'desc')->limit(60)->get();
            $data['warehouses'] = Warehouse::orderBy('created_at', 'desc')->limit(60)->get();
        } else {
            $data['my_warehouse'] = collect([$user->warehouse()]);
            
            $user_id = $user->id;
            $data['warehouses'] = Warehouse::whereHas('staff', function ($query) use ($user_id) {
                // Exclude the current user from the query
                $query->where('id', '!=', $user_id);
            })->get();

            // dd($data['my_warehouse']);
        }
        // dd($data);
        $data['stores'] = Store::orderBy('created_at', 'desc')->limit(100)->get();
        return parent::render($data, 'transfer.add_warehouse_transfer');
    }

    private function store_transfer(array $data) {
        $user = Auth::user();
        if($user->hasRole('admin')) {
            $data['my_warehouse'] = Warehouse::orderBy('created_at', 'desc')->limit(60)->get();
            $data['warehouses'] = Warehouse::orderBy('created_at', 'desc')->limit(60)->get();
        } else {
            $data['my_warehouse'] = collect([$user->warehouse()]);
            
            $user_id = $user->id;
            $data['warehouses'] = Warehouse::whereHas('staff', function ($query) use ($user_id) {
                // Exclude the current user from the query
                $query->where('id', '!=', $user_id);
            })->get();

            // dd($data['my_warehouse']);
        }
        // dd($data);
        $data['stores'] = Store::orderBy('created_at', 'desc')->limit(100)->get();
        return parent::render($data, 'transfer.add_store_transfer');
    }
}
