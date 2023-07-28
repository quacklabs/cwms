<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\User;

class Action extends Model
{
    use HasFactory;
    protected $table = 'action';
    protected $fillable = ['action', 'model_type', 'model_id', 'user_id'];
    protected $appends = ['user', 'model'];

    public function getModelAttribute() {
        return $this->model();
    }

    public function model(): MorphTo {
        return $this->morphTo();
    }

    public function getUserAttribute() {
        return $this->actionUser();
    }


    protected function actionUser() {
        return User::find($this->user_id);
    }

    // public function morphable(): 
    // {
    //     return $this->morphTo();
    // }
}
