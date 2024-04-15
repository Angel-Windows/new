<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
