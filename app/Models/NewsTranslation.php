<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'body',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
}
