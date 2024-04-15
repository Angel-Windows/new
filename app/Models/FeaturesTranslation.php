<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturesTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
