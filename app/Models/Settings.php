<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use File;
use Image;

class Settings extends Model
{
    use Translatable;

    protected $table = 'dv_settings';
    protected $guarded = [];
    public $timestamps = false;

    public $translatedAttributes = [
        'footText',
        'copir',
        'address',
    ];

    public static function saveSettings( $image ){


        $filename  = time() . '.' . $image->getClientOriginalExtension();

        $img = Image::make($image->getRealPath());
        $img->fit( 300, 66 )->save( public_path('uploads/logo/' . $filename) );

        return $filename;
    }
    public static function saveSettingsBaner( $image ){
		$filename  = time() . '.' . $image->getClientOriginalExtension();

		$img = Image::make($image->getRealPath());
		$img->fit( 320, 310 )->save( public_path('uploads/sldies/' . $filename) );

		return $filename;
	}

}
