<?php

use Illuminate\Database\Seeder;

class FeaturesSeederTranslation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\Features::create([
//            'ru' => [
//                'name' => ' name ru',
//            ],
//
//            'uk' => [
//                'name' => ' name uk',
//            ],
//        ]);
        $featuries = \App\Models\Features::get()->toArray();

        foreach ($featuries as $feature) {

            $item = \App\Models\Features::find($feature['id']);

            $item->update([
                'ru' => [
                    'name' => $feature['name'],

                ],

                'uk' => [
                    'name' => ' nam uk',
                ],
            ]);
        }
    }
}
