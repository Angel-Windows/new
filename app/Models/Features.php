<?php

namespace App\Models;

use App\Models\Scope\TranslationScope;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Features extends Model
{
    use Translatable;
    use TranslationScope;

	protected $table = 'dv_features';
	protected $guarded = [];

    public $translatedAttributes = [
        'name',
    ];

    /**
     * @return HasMany
     */
	public function options(): HasMany
    {
		return $this->hasMany( 'App\Models\Options' , 'feature_id' );
	}

    /**
     * @return HasMany
     */
	public function variants(): HasMany
    {
		return $this->hasMany( 'App\Models\OptionVariants' , 'feature_id' );
	}
}
