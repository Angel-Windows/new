<?php

use Illuminate\Database\Seeder;

class CharLisOptionVariantstSeederTranslation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\CharlistOptionVariants::create([
//            'charlist_id' => 7,
//            'ru' => [
//                'name' => ' name ru',
//            ],
//
//            'uk' => [
//                'name' => ' name uk',
//            ],
//        ]);

        $variants = \App\Models\CharlistOptionVariants::get()->toArray();

        foreach ($variants as $variant) {

            $item = \App\Models\CharlistOptionVariants::find($variant['id']);

            $item->update([
                'ru' => [
                    'name' => $variant['name'],

                ],

                'uk' => [
                    'name' => $variant['name'],
                ],
            ]);
        }
    }
}
