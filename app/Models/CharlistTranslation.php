<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharlistTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
