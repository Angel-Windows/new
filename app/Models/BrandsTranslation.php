<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandsTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'body',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
}
