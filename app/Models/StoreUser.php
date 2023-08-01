<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Store;
use App\Models\User;

class StoreUser extends Model
{
    use HasFactory;
    protected $table = "store_user";

    protected $fillable = [
        "store_id", "user_id"
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
