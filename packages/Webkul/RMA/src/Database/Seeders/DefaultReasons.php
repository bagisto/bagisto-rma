<?php

namespace Webkul\RMA\Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\RMA\Models\RMAReasons;

class DefaultReasons extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creating default reasons for return management
        RMAReasons::create([
            'title'  => 'Manufacturer defect',
            'status' => 1,
        ]);

        RMAReasons::create([
            'title'  => 'Damaged during shipping',
            'status' => 1,
        ]);

        RMAReasons::create([
            'title'  => 'Wrong description online',
            'status' => 1,
        ]);

        RMAReasons::create([
            'title'  => 'Dead on arrival',
            'status' => 1,
        ]);
    }
}
