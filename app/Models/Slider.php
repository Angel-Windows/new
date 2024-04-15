<?php

namespace App\Models;

use App\Models\Scope\TranslationScope;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Image;
use File;

class Slider extends Model
{
    use Translatable;
    use TranslationScope;

	protected $table = 'dv_slider';
	protected $guarded = [];

    public $translatedAttributes = [
        'title',
        'text',
        'textButton',
    ];


	public static function saveSlide( $image ){

		$filename  = time() . '.' . $image->getClientOriginalExtension();

		$img = Image::make($image->getRealPath());
		$img->fit( 375, 230)->save( public_path('uploads/slides/' . $filename) );

		$slide = self::create(['image' => $filename]);
		return $slide->id;
	}

	public static function destroy( $ids ){

		$slides = self::whereIn('id', $ids)->get();

		foreach( $slides as $sl )
			File::delete( public_path('uploads/slides/'.$sl->image) );

		parent::destroy( $ids );
	}
}
