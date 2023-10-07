<?php

namespace App\Models\AppModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

use App\Contracts\BackgroundTask;

class Task extends Model implements BackgroundTask {
    use HasFactory, Prunable;

    const STATUS_QUEUED = 'queued';
    const STATUS_RETRYING = 'retrying';
    const STATUS_STARTED = 'started';
    const STATUS_FINISHED = 'finished';
    const STATUS_FAILED = 'failed';

    const STATUSES = [
        self::STATUS_QUEUED,
        self::STATUS_RETRYING,
        self::STATUS_STARTED,
        self::STATUS_FINISHED,
        self::STATUS_FAILED,
    ];

    protected $table = 'queued_jobs';
    // protected $keyType = 'int';

    protected $fillable = [
        // 'uuid',
        'user_id',
        'trackable_id',
        'trackable_type',
        'name',
        'status',
        'output',
        'started_at',
        'finished_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    // public function __construct(array $attributes = [])
    // {
    //     parent::__construct($attributes);
    //     $this->setTable(config('trackable-jobs.tables.tracked_jobs', 'tracked_jobs'));

    //     // if (config('trackable-jobs.using_uuid', false)) {
    //     //     $this->setKeyType('string');
    //     //     $this->primaryKey = 'uuid';
    //     //     $this->setIncrementing(false);
    //     // }
    // }

    // public function __construct(array $attributes = [])
    // {
    //     parent::__construct($attributes);
    //     // $this->setTable(config('trackable-jobs.tables.tracked_jobs', 'tracked_jobs'));

    //     // if (config('trackable-jobs.using_uuid', false)) {
    //     //     $this->setKeyType('string');
    //     //     $this->primaryKey = 'uuid';
    //     //     $this->setIncrementing(false);
    //     // }
    // }

    public function prunable()
    {
        // if (is_null(config('trackable-jobs.prunable_after'))) {
        //     return static::query()->where('id', null);
        // }

        return static::where('created_at', '<=', now()->subDays(1));
    }

    public function trackable(): MorphTo
    {
        return $this->morphTo('trackable', 'trackable_type', 'trackable_id');
    }

    public function markAsStarted(): bool
    {
        return $this->update([
            'status' => static::STATUS_STARTED,
            'started_at' => now(),
        ]);
    }

    public function markAsQueued(): bool
    {
        return $this->update([
            'status' => static::STATUS_QUEUED,
        ]);
    }

    public function markAsRetrying(): bool
    {
        return $this->update([
            'status' => static::STATUS_RETRYING,
        ]);
    }

    public function markAsFinished(string $message = null): bool
    {
        if ($message) {
            $this->setOutput($message);
        }

        return $this->update([
            'status' => static::STATUS_FINISHED,
            'finished_at' => now(),
        ]);
    }

    public function markAsFailed(string $exception = null): bool
    {
        if ($exception) {
            $this->setOutput($exception);
        }

        return $this->update([
            'status' => static::STATUS_FAILED,
            'finished_at' => now(),
        ]);
    }

    public function setOutput(string $output): bool
    {
        return $this->update([
            'output' => $output,
        ]);
    }

    /**
     * Whether the job has already started.
     *
     * @return bool
     */
    public function hasStarted(): bool
    {
        return ! empty($this->started_at);
    }

    /**
     * Get the duration of the job, in human diff.
     *
     * @throws \Exception
     *
     * @return string
     */
    public function getDurationAttribute(): string
    {
        if (! $this->hasStarted()) {
            return '';
        }

        return ($this->finished_at ?? now())
            ->diffAsCarbonInterval($this->started_at)
            ->forHumans(['short' => true]);
    }

    // protected static function newFactory(): Factory
    // {
    //     return new TrackFactory();
    // }
}