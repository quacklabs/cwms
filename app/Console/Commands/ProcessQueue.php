<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ProcessQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:health';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $processName = 'background_queue_worker';
        $command = ['ps', 'aux'];

        $process = new Process(['pgrep', '-f', 'queue:work']);
        $process->run();

        if ($process->isSuccessful()) {
            $this->info('The queue worker is running.');
            return;
        } else {
            Artisan::call('');
            // Log::debug(Artisan::output());
            // Log::debug('Worker Run');
        }

        if ($process->isRunning()) {
            $process->stop();
        }
    }
}
