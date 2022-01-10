<?php

namespace Webkul\RMA\Database\Seeders;

use  Webkul\Core\Models\CoreConfig;
use Illuminate\Database\Seeder;

class RMAConfiguration extends Seeder
{
    public function run()
    {
        CoreConfig::create([
            'code'         => 'rma.settings.general.enable_rma',
            'value'        => '1',
            'channel_code' => 'default',
            'locale_code'  => 'en'
        ]);
        CoreConfig::create([
            'code'         => 'rma.settings.general.enable_rma',
            'value'        => '1',
            'channel_code' => 'default',
            'locale_code'  => 'fr'
        ]);
        CoreConfig::create([
            'code'         => 'rma.settings.general.enable_rma',
            'value'        => '1',
            'channel_code' => 'default',
            'locale_code'  => 'nl'
        ]);
        CoreConfig::create([
            'code'         => 'rma.settings.general.enable_rma',
            'value'        => '1',
            'channel_code' => 'default',
            'locale_code'  => 'tr'
        ]);
    }
}