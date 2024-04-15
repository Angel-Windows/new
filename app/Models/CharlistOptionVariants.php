<?php
/**
 * Created by PhpStorm.
 * User: Dvacom
 * Date: 29.05.2017
 * Time: 10:18
 */

namespace App\Models;
use App\Models\Scope\TranslationScope;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class CharlistOptionVariants extends Model
{
    use Translatable;
    use TranslationScope;

    protected $table = 'dv_charlist_option_variants';
    protected $guarded = [];

    public $translatedAttributes = [
        'name',
    ];
}