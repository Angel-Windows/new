<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FeatureRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
//        return [
//            'name' => 'required'
//        ];


        foreach (config('translatable.locales') as $locale) {
            $rules[$locale.'.name'] = 'required';
        }

        return $rules;
    }
}
