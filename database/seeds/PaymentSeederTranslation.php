<?php

use Illuminate\Database\Seeder;

class PaymentSeederTranslation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\Payment::create([
//            'ru' => [
//                'name' => ' name ru',
//            ],
//
//            'uk' => [
//                'name' => ' name uk',
//            ],
//        ]);

        $payments = \App\Models\Payment::get()->toArray();

        foreach ($payments as $payment) {

            $item = \App\Models\Payment::find($payment['id']);

            $item->update([
                'ru' => [
                    'name' => $payment['name'],

                ],

                'uk' => [
                    'name' => ' nam uk',
                ],
            ]);
        }

    }
}
