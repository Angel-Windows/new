<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request
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
    public function rules()
    {
//        return [
//            'name' => 'required',
//            'slug' => 'required',
//            'image' => 'image|mimes:jpg,jpeg,png,gif'
//        ];

        $rules = [
            'slug' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif'
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules[$locale.'.name'] = 'required';
        }

        return $rules;
    }
}
