<?php

namespace App\Models;

use App\Models\Scope\TranslationScope;
use Dimsav\Translatable\Translatable;
use Baum\Node;
use File;
use Image;

class Category extends Node
{
    use Translatable;
    use TranslationScope;

    protected $table = 'dv_categories';
    protected $fillable = [
        'parent_id',
        'lft',
        'rgt',
        'depth',
        'slug',
        'image',
        'show_block_1',
        'show_block_2',
        'show_block_3',
        'gradient',
    ];

    public $translatedAttributes = [
        'name',
        'body',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    protected static $res = [];

    public function products()
    {
        return $this->hasMany('App\Models\ProductsCategories', 'category_id');
    }

    public static function categories_tree()
    {

        $categories = self::all();

        foreach ($categories as &$item) {
            $categories_tree[$item->parent_id][] = &$item;
        }
        unset($item);

        foreach ($categories as &$item) {
            if (isset($categories_tree[$item->id])) {
                $item['subcategories'] = $categories_tree[$item->id];
            }
        }

        return reset($categories_tree);
    }

    public static function clearRes()
    {
        self::$res = [];
    }

    public static function get_parent_categories($id)
    {

        $category = self::find($id);

        if (isset($category->parent_id) && $category->parent_id != 0) {
            array_push(self::$res, $category);
            self::get_parent_categories($category->parent_id);
        } else {
            array_push(self::$res, $category);
        }

        return array_reverse(self::$res);
    }


    public static function saveImage($image, $id)
    {

        $filename = time().'.'.$image->getClientOriginalExtension();

        $img = Image::make($image->getRealPath());
        $img->fit(263, 325)->save(public_path('uploads/category/'.$filename));

        self::find($id)->update(['image' => $filename]);
    }


    public static function updateImage($image, $id)
    {

        $old_filename = self::find($id)->image;
        File::delete(public_path().'/uploads/category/'.$old_filename);

        self::saveImage($image, $id);
    }


    public static function destroy($ids)
    {

        $post = self::whereIn('id', $ids)->get();

        foreach ($post as $p) {
            File::delete(public_path().'/uploads/category/'.$p->image);
        }

        parent::destroy($ids);
    }
}
