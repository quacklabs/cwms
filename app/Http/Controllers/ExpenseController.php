<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\SUpport\Facades\Auth;
use App\Models\Expense;
use App\Models\ExpenseType;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    //

    public function expenses(Request $request) {

        $user = Auth::user();
        if($request->method() == 'POST') {
            $valid = $request->validate([
                'date' => ['required', 'date'],
                'type_id' => ['required', 'numeric'],
                'amount' => ['required', 'decimal'],
            ]);
            $valid['created_by'] = $user->id;
            $valid['date'] = Carbon::now();
            Expense::create($valid);
            return redirect()->route('expense.expenses')->with('success', 'Expense added succedfully');
        }
        if($user->hasRole('admin')) {
            $expenses = Expense::orderBy('created_at','desc')->paginate(25);
        } else if($user->hasRole('manager')) {

            $warehouseId = $user->warehouse()->id;
            if($warehouseId) {
                $expenses = Expense::whereHas('staff', function ($query) use ($warehouseId) {
                    $query->where('warehouse', function ($subQuery) use ($warehouseId) {
                        $subQuery->where('warehouse_id', $warehouseId);
                    });
                })->paginate(25);
            } else {
                $collection = new Collection();
                // $currentPageItems = $collection->slice($offset, $perPage)->all();
                $expenses= new LengthAwarePaginator($collection, count($collection), 0, 1);
                // Set the path for the paginator
                $expenses->setPath(Request::url());
            }
        } else {

        }
        $data = [
            'title' => 'Expenses',
            'expenses' => $expenses,
            'types' => ExpenseType::all()
        ];

        return parent::render($data, 'expense.expenses');
    }

    public function expense_types(Request $request) {
        if($request->method() == 'POST') {
            $valid = $request->validate([
                'name' => ['required', 'string', 'unique:expense_type,name']
            ]);

            ExpenseType::create($valid);
            return redirect()->route('expense.types')->with('success', 'Expense type added successfully');
        }

        $data = [
            'title' => 'Expenses',
            'types' => ExpenseType::all()
        ];
        return parent::render($data, 'expense.expense_types');
    }
}
