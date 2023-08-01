<?php
namespace App\Models\AnalyticsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Contracts\TransactionInterface;

use App\Models\AnalyticsModels\TransactionDetail;

abstract class Transaction extends Model implements TransactionInterface {

    public function scopeProducts($query) {

        $builder = $query->getQuery();
       
        $builder->wheres = collect($builder->wheres)->reject(function($where) {
            return $where['type'] === 'Column' && $where['first'] === 'received';
        })->reject(function($where) {
            return $where['type'] === 'Exists';
        })->values()->all();

        $result = $builder->get()->flatMap(function($transaction) {
            $model = static::class;
            $transaction = $model::find($transaction->id);
            return $transaction->details;
        })->groupBy('product_id');
        return $result;
    }
    
    public function scopePending($query) {
        $builder = $query->getQuery();
        
        $builder->wheres = collect($builder->wheres)->reject(function($where) {
            return $where['type'] === 'Column' && $where['first'] === 'received';
        })->values()->all();
        $builder->whereColumn('received', '!=', DB::raw('total_price - discount_amount'));
        return $builder;
    }

    public function scopeComplete($query) {
        
        $builder = $query->getQuery();
        
        $builder->wheres = collect($builder->wheres)->reject(function($where) {
            return $where['type'] === 'Column' && $where['first'] === 'received';
        })->values()->all();
        $builder->whereColumn('received', '>=', DB::raw('total_price - discount_amount'));
        
        return $builder;
    }

    public function scopeCost($query) {
        $builder = $query->getQuery();

        $builder->wheres = collect($builder->wheres)->reject(function($where) {
            return $where['type'] === 'Column' && $where['first'] === 'received';
        })->values()->all();

        $cost = $builder->get()->sum('total_price');
        $discount = $builder->get()->sum('discount_amount');

        $net = $cost - $discount;
        return floatval($net);
    }

    // public function purchase(int $id): Purchase {
    //     $model = static::class;
    //     $transaction = $model::find($id);
    // }

    // public function sale(int $id): Sale {
    //     $model = static::class;
    //     $transaction = $model::find($id);
    // }

    abstract public function details(): HasMany;
    abstract public function payable(): float;
    abstract public function due(): float;
    abstract public function origin(): Model;

    // public function purchase(int $id): Purchase {
    //     return self::find($id);
    // }

    // public function sale(int $id): Sale {
    //     return Sale::find($id);
    //     // return self::find($id);
    // }
}
