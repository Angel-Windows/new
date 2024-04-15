<?php

namespace App\Services\Translation;

use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationService
{
    public function getTranslateText($text, $lang)
    {
        return  GoogleTranslate::trans($text, 'uk', 'ru') ?? $text;
    }

    public function getTranslateTextRu($text, $lang)
    {
        return  GoogleTranslate::trans($text, 'ru', 'uk') ?? $text;
    }
}