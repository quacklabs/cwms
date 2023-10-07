<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeInterfaceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:interface {name : The name of the interface}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new contract';

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
        $interfaceClass = $name;

        $path = app_path('Contracts') . '/' . $interfaceClass . '.php';

        if (File::exists($path)) {
            $this->error('Interface already exists!');
            return;
        }

        if(!is_dir(app_path('Contracts') . '/')) {
            File::makeDirectory(app_path('Contracts'));
        }

        $stub = str_replace(
            'YourInterfaceName',
            $interfaceClass,
            File::get(__DIR__ . '/stubs/interface.stub')
        );

        File::put($path, $stub);

        $this->info("$name Interface created successfully!");
    }
}
