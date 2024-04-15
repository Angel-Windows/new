<?php

use Illuminate\Database\Seeder;

class CharListSeederTranslation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\Charlist::create([
//            'ru' => [
//                'name' => ' name ru',
//            ],
//
//            'uk' => [
//                'name' => ' name uk',
//            ],
//        ]);

        $charlists = \App\Models\Charlist::get()->toArray();

        foreach ($charlists as $charlist) {

            $item = \App\Models\Charlist::find($charlist['id']);

            $item->update([
                'ru' => [
                    'name' => $charlist['name'],

                ],

                'uk' => [
                    'name' => ' nam uk',
                ],
            ]);
        }
    }
}
