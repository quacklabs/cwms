<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Session;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Warehouse;
use App\Policies\UserPolicy;
use App\Models\Store;
use App\Models\PermissionGroup;

use App\Models\Expense;
use App\Traits\ActionTakenBy;
use App\Models\AppModels\Task;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, ActionTakenBy;

    // protected $policy = UserPolicy::class;
    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'warehouse_id',
        'store_id',
        'name',
        'email',
        'username',
        'password',
        'mobile',
    ];
    protected $appends = [
        'pendingJobs',
        'activeJobs'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
    * @return string
    */
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }


    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
    * @return string
    */
    public function getImageAttribute() {
        $directory = public_path('uploads/avatars/'.$this->username.'.*');
        $file = glob($directory);
        if (!empty($files)) {
            return '';
        } else {
            return asset('img/avatar-1.png');
        }
    }

    public function warehouse() {
        // dd($this->warehouse_id);
        if(isset($this->warehouse_id)) {
            $id = $this->warehouse_id;
            return Warehouse::where('id', $id)->get()->first();
        }
        return null;
    }

    public function jobs(): HasMany {
        return $this->hasMany(Task::class, 'user_id');
    }

    // public function store() {
    //     // dd($this->warehouse_id);
    //     if(isset($this->store_id)) {
    //         $id = $this->store_id;
    //         return Store::where('id', $id)->get()->first();
    //     }
    //     return null;
    // }

    public function managedWarehouse() {
        return Warehouse::where('manager_id', $this->id)->first();
    }

    public function store() {
        return $this->belongsToMany(Store::class);
    }

    public function hasPermissionToGroup($group) {
        // dd($group);
        $group = PermissionGroup::where('name', $groupName)->first();

        if (!$group) {
            return false;
        }
        
        return $this->hasRole($group->roles);
    }

    /**
     * Generate an API token for the user.
     *
     * @return string
     */
    public function generateApiToken()
    {
        $token = $this->createToken('Bearer')->plainTextToken;
        Session::put('api_token', $token);
    }

    public function expenses() {
        return $this->hasMany(Expenses::class, 'created_by');
    }

    public function getPendingJobsAttribute() {
        $filteredPosts = $this->jobs->filter(function ($job) {
            return $job->status == Task::STATUS_QUEUED || $job->status == Task::STATUS_RETRYING;
        });
        return collect($filteredPosts);
    }

    public function getActiveJobsAttribute() {
        $filteredPosts = $this->jobs->filter(function ($job) {
            return $job->status == Task::STATUS_STARTED;
        });
        return collect($filteredPosts);
    }
}
