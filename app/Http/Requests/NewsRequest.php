<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Astrotomic\Translatable\Validation\RuleFactory;

class NewsRequest extends Request
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
//        return [
//            'name' => 'required',
//            'slug' => 'required',
//            // 'description' => 'required',
//        ];

        $rules = [
            'slug' => 'required',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules[$locale.'.name'] = 'required';
        }

        return $rules;
    }

}
