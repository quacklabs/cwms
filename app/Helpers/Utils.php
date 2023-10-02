<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class Utils {

    public static function calculateSmartChunk(int $number, int $defaultChunkSize = 100): int {
        $memoryLimit = 32; //baseline of 32M memory limit to account for shared hosting environments

        // Estimate memory usage with the default chunk size
        $memoryUsage = memory_get_usage() + $number; // Adjust based on your algorithm's actual memory usage

        // Check if available memory is sufficient
        if ($memoryUsage >= 0.9 * $memoryLimit) {
            // Reduce chunk size to conserve memory
            $chunkSize = $defaultChunkSize / 2;
        } else {
            // Use the default chunk size
            $chunkSize = $defaultChunkSize;
        }
        return intval(floor($chunkSize));
    }

    public static function smartChunk($number) {
        // $number = $this->count();
        
    }
}