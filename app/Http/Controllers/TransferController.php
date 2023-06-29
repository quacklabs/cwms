<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\TransferService;
use App\Models\Warehouse;

class TransferController extends Controller
{
    //

    public function transfers(Request $request) {
        $user = Auth::user();
        if($user->hasRole('admin')) {
            $transfers = TransferService::getAllPaginated();
        } else {
            $my_warehouse = $user->warehouse->first()->id;
            $transfers = TransferService::getByWarehouse($my_warehouse);
        }
        $data = [
            'title' => 'Transfers',
            'transfers' => $transfers
        ];

        return parent::render($data, 'transfer.transfers');
    }

    public function create_transfer(Request $request) {
        $user = Auth::user();

        if($request->method() == 'POST') {
            $valid = $request->validate([
                'from_warehouse' => ['required', 'numeric'],
                'to_warehouse' => ['required', 'numeric'],
                'notes' => ['nullable', 'string'],
                'items' => ['required'],
                'transfer_date' => ['required', 'date']
            ]);
            TransferService::createTransfer($valid);
        }

        if($user->hasRole('admin')) {
            $from_warehouse = Warehouse::orderBy('created_at', 'desc')->paginate(60);
            $to_warehouse = Warehouse::orderBy('created_at', 'desc')->paginate(60);
        } else {
            $from_warehouse = auth()->user()->warehouse;
            $to_warehouse = Warehouse::whereDoesntHave('staff', function ($query) use ($user) {
                $query->where('id', $user->id);
            })->paginate(25);
        }
        $data = [
            'title' => 'Make Transfer',
            'from_warehouse' => $from_warehouse,
            'to_warehouse' => $to_warehouse
        ];

        return parent::render($data, 'transfer.add_transfer');
    }
}