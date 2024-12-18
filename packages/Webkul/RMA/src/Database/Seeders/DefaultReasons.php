<?php

namespace Webkul\RMA\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultReasons extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Inserting default reasons for RMA.
         */
        DB::table('rma_reasons')->delete();

        DB::table('rma_reasons')->insert([
            [
                'title'      => 'Manufacturer defect',
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'title'      => 'Damaged during shipping',
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'title'      => 'Wrong description online',
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'title'      => 'Dead on arrival',
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $reasons = DB::table('rma_reasons')->get();

        $resolutionTypes = [
            'exchange',
            'return',
            'cancel-items',
        ]; 

        $now = Carbon::now();

        foreach ($reasons as $reason) {
            foreach ($resolutionTypes as $resolutionType) {
                DB::table('rma_reason_resolutions')->insert([
                    'rma_reason_id'   => $reason->id,
                    'resolution_type' => $resolutionType,
                    'created_at'      => $now,
                    'updated_at'      => $now,
                ]);
            }
        }
    }
}