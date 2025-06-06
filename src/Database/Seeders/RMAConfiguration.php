<?php

namespace Webkul\RMA\Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Core\Models\CoreConfig;

class RMAConfiguration extends Seeder
{
    /**
     * Create a new RMAConfiguration
     */
    public function run(): void
    {
        if (! core()->getConfigData('rma.settings.general.enable_rma')) {
            CoreConfig::insert([
                'code'         => 'rma.settings.general.enable_rma',
                'value'        => '1',
                'channel_code' => 'default',
                'locale_code'  => 'en',
            ], [
                'code'         => 'rma.settings.general.enable_rma',
                'value'        => '1',
                'channel_code' => 'default',
                'locale_code'  => 'fr',
            ], [
                'code'         => 'rma.settings.general.enable_rma',
                'value'        => '1',
                'channel_code' => 'default',
                'locale_code'  => 'nl',
            ], [
                'code'         => 'rma.settings.general.enable_rma',
                'value'        => '1',
                'channel_code' => 'default',
                'locale_code'  => 'tr',
            ]);
        }
    }
}