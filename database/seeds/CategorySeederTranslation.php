<?php

use Illuminate\Database\Seeder;

class CategorySeederTranslation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\Category::create([
//            'show_block_1'=>1,
//            'show_block_3'=>0,
//            'show_block_2'=>0,
//            'slug'=>'category',
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

        $brands = \App\Models\Category::get()->toArray();

        foreach ($brands as $brand) {

            $item = \App\Models\Category::find($brand['id']);

            $item->update([

//                'parent_id' => $brand['parent_id'],
//                'lft' => $brand['lft'],
//                'rgt' => $brand['rgt'],
//                'slug' => $brand['slug'],
//                'depth' => $brand['depth'],
//                'image' => $brand['image'],
//                'show_block_1' => $brand['show_block_1'],
//                'show_block_2' => $brand['show_block_2'],
//                'show_block_3' => $brand['show_block_3'],
//                'gradient' => $brand['gradient'],

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
