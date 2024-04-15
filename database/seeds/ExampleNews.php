<?php

use Illuminate\Database\Seeder;

class ExampleNews extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $news = \App\Models\News::get()->toArray();

        foreach ($news as $new) {

            $item = \App\Models\News::where('id', $new['id'])->first();

            $item->update([
                'ru' => [
                    'name' => $new['name'],
                    'description' => $new['description'],
                    'body' => $new['body'],
                    'meta_title' => $new['meta_title'],
                    'meta_keywords' => $new['meta_keywords'],
                    'meta_description' => $new['meta_description'],
                ],

                'uk' => [
                    'name' => ' nam uk',
                    'description' => 'description uk',
                    'body' => 'body uk',
                    'meta_title' => '',
                    'meta_keywords' => '',
                    'meta_description' => '',
                ],
            ]);
        }
    }
}
