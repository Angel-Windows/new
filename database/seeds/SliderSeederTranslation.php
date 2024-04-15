<?php

use Illuminate\Database\Seeder;

class SliderSeederTranslation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        \App\Models\Slider::create([
//            'image'=>'/upload',
//            'link'=>'/upload/link',
//            'ru' => [
//                'title' => $page['title'] ?? '-',
//                'text' => $page['text'] ?? '-',
//                'textButton' => $page['textButton'] ?? '-',
//            ],
//
//            'uk' => [
//                'title' => ' title uk',
//                'text' => ' text uk',
//                'textButton' => ' textButton uk',
//            ],
//        ]);

        $sliders = \App\Models\Slider::where('id', 120)->get()->toArray();

        foreach ($sliders as $page) {
            $item = \App\Models\Slider::find(120);
            $item->update([
                'ru' => [
                    'title' => $page['title'] ?? '-',
                    'text' => $page['text'] ?? '-',
                    'textButton' => $page['textButton'] ?? '-',
                ],

                'uk' => [
                    'title' => ' title uk',
                    'text' => ' text uk',
                    'textButton' => ' textButton uk',
                ],
            ]);
        }
    }
}
