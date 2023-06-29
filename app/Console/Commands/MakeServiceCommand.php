<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name : The name of the service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $name = $this->argument('name');
        $serviceClass = $name . 'Service';

        $path = app_path('Services') . '/' . $serviceClass . '.php';

        if (File::exists($path)) {
            $this->error('Service class already exists!');
            return;
        }

        if(!is_dir(app_path('Services') . '/')) {
            File::makeDirectory(app_path('Services'));
        }

        $stub = str_replace(
            'YourServiceName',
            $serviceClass,
            File::get(__DIR__ . '/stubs/service.stub')
        );

        File::put($path, $stub);

        $this->info("$name Service created successfully!");
    }
}
