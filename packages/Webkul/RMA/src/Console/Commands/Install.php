<?php

namespace Webkul\RMA\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rma:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the RMA package';

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
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('migrate', [], $this->getOutput());

        Artisan::call('db:seed', [
            '--class' => 'Webkul\\RMA\\Database\\Seeders\\DatabaseSeeder',
        ], $this->getOutput());

        Artisan::call('optimize', [], $this->getOutput());

        Artisan::call('vendor:publish', [
            '--provider' => "Webkul\RMA\Providers\RMAServiceProvider",
            '--force'    => true,
        ], $this->getOutput());
    }
}
