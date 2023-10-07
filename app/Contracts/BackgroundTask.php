<?php
namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphTo;

interface BackgroundTask {
    public function trackable(): MorphTo;
    public function markAsStarted(): bool;
    public function markAsFinished(string $message = null): bool;
    public function markAsFailed(string $exception = null): bool;

    // public function setOutput(string $output): bool;
}