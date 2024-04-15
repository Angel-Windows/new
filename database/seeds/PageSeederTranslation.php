<?php

use Illuminate\Database\Seeder;

class PageSeederTranslation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\Page::create([
//            'type'=>'bay',
//            'slug'=>'bay',
//            'ru' => [
//                'name' => '000',
//                'description' => '000',
//                'body' => '000',
//                'meta_title' => '000',
//                'meta_keywords' => '000',
//                'meta_description' => '000',
//            ],
//
//            'uk' => [
//                'name' => ' nam uk',
//                'description' => 'description uk',
//                'body' => 'body uk',
//                'meta_title' => '0',
//                'meta_keywords' => '0',
//                'meta_description' => '0',
//            ],
//        ]);

        $pages = \App\Models\Page::where('id', 44 )->get()->toArray();

        foreach ($pages as $page) {
            $item = \App\Models\Page::find(44);
            $item->update([
                'type' => $page['type'] ?? 'other',
                'ru' => [
                    'name' => $page['name'] ?? '000',
                    'description' => $page['description'] ?? '000',
                    'body' => $page['body'] ?? '000',
                    'meta_title' => $page['meta_title'] ?? '000',
                    'meta_keywords' => $page['meta_keywords'] ?? '000',
                    'meta_description' => $page['meta_description'] ?? '000',
                ],

                'uk' => [
                    'name' => ' nam uk',
                    'description' => 'description uk',
                    'body' => 'body uk',
                    'meta_title' => '0',
                    'meta_keywords' => '0',
                    'meta_description' => '0',
                ],
            ]);

        }
    }
}
