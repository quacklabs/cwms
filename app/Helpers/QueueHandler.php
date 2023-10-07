<?php
namespace App\Helpers;

use Illuminate\Queue\Connectors\DatabaseConnector;
use Illuminate\Queue\DatabaseQueue;
use Illuminate\Support\Facades\Log;

// class QueueConnector extends DatabaseConnector {
//     /**
//      * Establish a queue connection.
//      *
//      * @param  array  $config
//      * @return \Illuminate\Contracts\Queue\Queue
//      */
//     public function connect(array $config)
//     {
//         $connection = parent::connect($config);

//         return new CustomDatabaseQueue(
//             $connection,
//             $config['table'],
//             $config['queue'],
//             $config['retry_after']
//         );
//     }
// }

class QueueHandler extends DatabaseQueue
{
    /**
     * Push a new job onto the queue.
     *
     * @param  string  $queue
     * @param  string  $job
     * @param  mixed   $data
     * @return mixed
     */
    public function push($job, $data = '', $queue = null)
    {
        $payload = $this->createPayload($job, $data);

        $id = $this->database->table($this->table)->insertGetId([
            'queue' => $queue ?? 'default',
            'payload' => $payload,
            'attempts' => 0,
            'reserved_at' => null,
            'available_at' => now(),
            'created_at' => now(),
        ]);
        Log::debug("Job id: ".$id);

        // Trigger a custom event when a job is added to the database
        // event(new JobAddedToDatabase($queue, $id));

        return $id;
    }
}