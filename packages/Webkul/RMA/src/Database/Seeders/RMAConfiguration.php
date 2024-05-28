<?php

namespace Webkul\RMA\Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Core\Models\CoreConfig;

class RMAConfiguration extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setting: Enable RMA for English locale
        CoreConfig::create([
            'code'         => 'rma.settings.general.enable_rma',
            'value'        => '1',
            'channel_code' => 'default',
            'locale_code'  => 'en',
        ]);

        // Setting: Enable RMA for French locale
        CoreConfig::create([
            'code'         => 'rma.settings.general.enable_rma',
            'value'        => '1',
            'channel_code' => 'default',
            'locale_code'  => 'fr',
        ]);

        // Setting: Enable RMA for Dutch locale
        CoreConfig::create([
            'code'         => 'rma.settings.general.enable_rma',
            'value'        => '1',
            'channel_code' => 'default',
            'locale_code'  => 'nl',
        ]);

        // Setting: Enable RMA for Turkish locale
        CoreConfig::create([
            'code'         => 'rma.settings.general.enable_rma',
            'value'        => '1',
            'channel_code' => 'default',
            'locale_code'  => 'tr',
        ]);
    }
}
