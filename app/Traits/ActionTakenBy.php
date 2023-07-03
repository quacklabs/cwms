<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\Action;

trait ActionTakenBy {

    public static function bootActionTakenBy()
    {
        static::created(function ($model) {
            $model->logEntry('created', $model->getKey());
        });

        static::updating(function ($model) {
            $model->logEntry('updated', $model->getKey());
        });

        static::deleting(function ($model) {
            $model->logEntry('deleted', $model->getKey());
        });
    }

    protected function logEntry($action, $model)
    {
        $userId = Auth::user()->id ?? null;
        // $model->save();

        $log = Action::create([
            'action' => $action,
            // 'model_type' => static::class,
            'model_id' => $model,
            'user_id' => $userId,
        ]);
        // $parent->actions()->save($action);
        $this->logs()->save($log);
    
        // Associate the logged model if available
        // if ($this->exists) {
        //     $log->model()->associate($this);
        //     $log->save();
        // }
    }

    public function logs()
    {
        return $this->morphMany(Action::class, 'model_type');
    }

    public function createdBy()
    {
        return $this->morphOne(Action::class, 'model_type')->where('action_name', 'CREATED');
    }
}