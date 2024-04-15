<?php
/**
 * Created by PhpStorm.
 * User: Dvacom
 * Date: 29.05.2017
 * Time: 10:13
 */

namespace App\Models;
use App\Models\Scope\TranslationScope;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Charlist extends Model
{
    use Translatable;
    use TranslationScope;

    protected $table = 'dv_charlist';
    protected $guarded = [];

    public $translatedAttributes = [
        'name',
    ];

    /**
     * @return HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany( 'App\Models\CharlistOptions' , 'charlist_id' );
    }

    /**
     * @return HasMany
     */
    public function variants(): HasMany
    {
        return $this->hasMany( 'App\Models\CharlistOptionVariants' , 'charlist_id' )->withTranslation();
    }
}