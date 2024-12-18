<?php

namespace Webkul\RMA\Console\Commands;

use Illuminate\Console\Command;
use Webkul\RMA\Database\Seeders\DatabaseSeeder;

class InstallRMA extends Command
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
    protected $description = 'Install RMA Module';

    /**
     * Install and configure RMA.
     */
    public function handle()
    {
        $this->warn('Step 1: Migrating all tables into database (will take a while)...');
        $this->call('migrate');

        $this->warn('Step 2: Seeding data into database tables...');
        $this->info(app(DatabaseSeeder::class)->run());

        $this->warn('Step 3: Publishing Assets and Configurations...');
        $this->info($this->call('vendor:publish', [
            '--provider' => \Webkul\RMA\Providers\RMAServiceProvider::class,
            '--force'    => true,
        ]));

        $this->warn('Step 4: Clearing cached bootstrap files...');
        $this->call('optimize:clear');
    }
}