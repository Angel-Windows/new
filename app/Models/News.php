<?php

namespace App\Models;

use App\Models\Scope\TranslationScope;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use File;
use Image;


class News extends Model
{
    use Translatable;
    use TranslationScope;

    protected $table = 'dv_news';
    protected $guarded = [];
    protected $perPage = 15;

    public $translatedAttributes = [
        'name',
        'description',
        'body',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];


    public static function saveImage($image, $id)
    {

        $filename = time().'.'.$image->getClientOriginalExtension();

        $img = Image::make($image->getRealPath());
        $img->fit(263, 160)->save(public_path('uploads/news/'.$filename));

        self::find($id)->update(['image' => $filename]);
    }


    public static function updateImage($image, $id)
    {

        $old_filename = self::find($id)->image;
        File::delete(public_path().'/uploads/news/'.$old_filename);

        self::saveImage($image, $id);
    }


    public static function destroy($ids)
    {

        $post = self::whereIn('id', $ids)->get();

        foreach ($post as $p) {
            File::delete(public_path().'/uploads/news/'.$p->image);
        }

        parent::destroy($ids);
    }
}
