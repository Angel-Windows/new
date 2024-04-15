<?php

namespace App\Models;

use App\Models\Scope\TranslationScope;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use Translatable;
    use TranslationScope;

	protected $table = 'dv_payment';
	protected $guarded = [];

    public $translatedAttributes = [
        'name',
    ];


	public static function destroy( $ids ){

		$post = self::whereIn( 'id', $ids )->get();

		parent::destroy( $ids );
	}
}
