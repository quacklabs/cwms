<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ExpenseType;
use App\Models\User;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "expense";

    protected $fillable = [
        'type_id','created_by','date','amount'
    ];

    public function type() {
        return $this->belongsTo(ExpenseType::class, 'type_id');
    }

    public function staff(){
        return $this->belongsTo(User::class, 'created_by');
    }
    
}
