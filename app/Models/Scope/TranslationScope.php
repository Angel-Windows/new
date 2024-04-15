<?php

namespace App\Models\Scope;

trait TranslationScope
{
    public function scopeTrans($query)
    {
        return $query->withTranslation()->translatedIn(app()->getLocale());
    }
}