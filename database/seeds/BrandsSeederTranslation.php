<?php

use Illuminate\Database\Seeder;

class BrandsSeederTranslation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\Brands::create([
//            'slug'=>'brands',
//            'image'=>'/image/',
//            'ru' => [
//                'name' => ' nam ru',
//                'body' => 'body ru',
//                'meta_title' => 'meta_title',
//                'meta_keywords' => 'meta_keywords',
//                'meta_description' => 'meta_description',
//            ],
//
//            'uk' => [
//                'name' => ' nam uk',
//                'body' => 'body uk',
//                'meta_title' => 'meta_title uk',
//                'meta_keywords' => 'meta_keywords uk',
//                'meta_description' => 'meta_description uk',
//            ],
//        ]);

        $brands = \App\Models\Brands::get()->toArray();

        foreach ($brands as $brand) {

            $item = \App\Models\Brands::find($brand['id']);

            $item->update([
                'ru' => [
                    'name' => $brand['name'],
                    'body' => $brand['body'],
                    'meta_title' => $brand['meta_title'],
                    'meta_keywords' => $brand['meta_keywords'],
                    'meta_description' => $brand['meta_description'],
                ],

                'uk' => [
                    'name' => ' nam uk',
                    'body' => 'body uk',
                    'meta_title' => '-',
                    'meta_keywords' => '-',
                    'meta_description' => '-',
                ],
            ]);
        }

    }
}
