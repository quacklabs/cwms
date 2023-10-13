<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use Pusher\PushNotifications\PushNotifications;

use App\Models\User;
use App\Events\TaskCompletedEvent;



trait Notifies {

    public function sendNotification(Model $model, string $message) {
        $user = User::find($model->user_id)->first();
        if($user){
            TaskCompletedEvent::dispatch($user, $message);
        }
        
    }
}