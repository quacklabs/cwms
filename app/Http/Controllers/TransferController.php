<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Warehouse;
use App\Models\Transfer;
use App\Models\TransferDetail;
use App\Models\ProductStock;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TransferController extends Controller
{
    //

    public function transfers(Request $request) {
        $user = Auth::user();
        if($user->hasRole('admin')) {
            $transfers = Transfer::orderBy('created_at', 'desc')->paginate(60);
            // $to_warehouse = Warehouse::orderBy('created_at', 'desc')->paginate(60);
        } else {
            $my_warehouse = $user->warehouse->first()->id;
            $transfers = Transfer::where('from_warehouse', $my_warehouse)->orWhere('to_warehouse', $my_warehouse)->paginate(1);
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
            $faker = Faker::create();
            $transfer = Transfer::create([
                'tracking_no' => strtoupper($faker->bothify('???########')),
                'from_warehouse' => $valid['from_warehouse'],
                'to_warehouse' => $valid['to_warehouse'],
                'transfer_date' => Carbon::parse($valid['transfer_date']),
                'note' =>$valid['notes']
            ]);

            if($transfer) {
                $orders = array_map(function($order) {
                    return [
                        'product_id' => $order->product_id,
                        'quantity' => $order->quantity,
                    ];
                }, json_decode($valid['items']));
                $transfer->details()->createMany($orders);
                $source_warehouse = $transfer->source_warehouse;
                $destination_warehouse = $transfer->destination_warehouse;

                $transfer->details->each(function($detail) use ($source_warehouse, $destination_warehouse, $transfer) {
                    $outgoing_stock = ProductStock::with('product')->where('warehouse_id', $source_warehouse->id)
                    ->where('product_id', $detail->product_id)->first();
                    if($outgoing_stock) {

                        $outgoing_stock->quantity = $outgoing_stock->quantity - $detail->quantity;

                        $incoming_stock = ProductStock::with('product')->where('warehouse_id', $destination_warehouse->id)
                        ->where('product_id', $detail->product_id)->first();

                        if($incoming_stock) {
                            $incoming_stock->quantity = $incoming_stock->quantity + $detail->quantity;
                            $incoming_stock->save();
                        } else {
                            $stock = ProductStock::create([
                                'product_id' => $detail->product_id,
                                'warehouse_id' => $destination_warehouse->id,
                                'quantity' => $detail->quantity
                            ]);
                        }
                        $outgoing_stock->save();
                        $transfer->balanced = true;
                        $transfer->save();
                        return redirect()->route('transfer.transfers')->with('success', 'Transfer completed successfully');
                    }
                });

            } else {
                return redirect()->route('transfer.transfers')->with('error', 'Could not create transfer, action not permitted');
            }
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
