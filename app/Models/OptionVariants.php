<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class OptionVariants extends Model
{
    use Translatable;

	protected $table = 'dv_option_variants';
	protected $guarded = [];

    public $translatedAttributes = [
        'name',
    ];
}
