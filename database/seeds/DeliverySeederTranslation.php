<?php

use Illuminate\Database\Seeder;

class DeliverySeederTranslation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\Delivery::create([
//            'price' => 10,
//            'ru' => [
//                'name' => ' name ru',
//            ],
//
//            'uk' => [
//                'name' => ' name uk',
//            ],
//        ]);

        $deliveries = \App\Models\Delivery::get()->toArray();

        foreach ($deliveries as $delivery) {

            $item = \App\Models\Delivery::find($delivery['id']);

            $item->update([
                'ru' => [
                    'name' => $delivery['name'],

                ],

                'uk' => [
                    'name' => ' nam uk',
                ],
            ]);
        }
    }
}
