<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = \App\Models\Settings::get()->toArray();

        foreach ($settings as $setting) {

            $item = \App\Models\Settings::find($setting['id']);

            $item->update([

                'ru' => [
                    'footText' => $setting['footText'],
                    'copir' => $setting['copir'],
                    'address' => $setting['address'],
                ],

                'uk' => [
                    'footText' => ' footText uk',
                    'copir' => 'copir uk',
                    'address' => 'address uk',
                ],
            ]);
        }
    }
}
