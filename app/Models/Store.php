<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse;

class Store extends Model
{
    use HasFactory;
    protected $table = 'store';
    protected $fillable = [
        'name','address','warehouse_id', 'status'
    ];
}
