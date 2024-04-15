<?php

use Illuminate\Database\Seeder;

class OptiobVariantsSeederTranslation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\OptionVariants::create([
//            'feature_id' => 3,
//            'ru' => [
//                'name' => ' name ru',
//            ],
//
//            'uk' => [
//                'name' => ' name uk',
//            ],
//        ]);

        $variants = \App\Models\OptionVariants::get()->toArray();

        foreach ($variants as $variant) {

            $item = \App\Models\OptionVariants::find($variant['id']);

            $item->update([
                'ru' => [
                    'name' => $variant['name'],

                ],

                'uk' => [
                    'name' => ' nam uk',
                ],
            ]);
        }

    }
}
