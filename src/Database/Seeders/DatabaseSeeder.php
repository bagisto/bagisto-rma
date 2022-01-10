<?php

namespace Webkul\RMA\Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Core\Models\CoreConfig;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RMAConfiguration::class);
    }
}
