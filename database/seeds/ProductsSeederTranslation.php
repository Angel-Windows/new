<?php

use Illuminate\Database\Seeder;

class ProductsSeederTranslation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = \App\Models\Products::get()->toArray();

        foreach ($brands as $brand) {

            $item = \App\Models\Products::find($brand['id']);

            $item->update([

                'ru' => [
                    'name' => $brand['name'],
                    'body' => $brand['body'],
                    'description' => $brand['description'],
                    'meta_title' => $brand['meta_title'],
                    'meta_keywords' => $brand['meta_keywords'],
                    'meta_description' => $brand['meta_description'],
                ],

                'uk' => [
                    'name' => ' nam uk',
                    'body' => 'body uk',
                    'description' => 'description uk',
                    'meta_title' => '-',
                    'meta_keywords' => '-',
                    'meta_description' => '-',
                ],
            ]);
        }
    }
}
