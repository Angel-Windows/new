<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DeliveryRequest extends Request
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
//            'price' => 'required'
//        ];

        $rules = [
            'price' => 'required',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules[$locale.'.name'] = 'required';
        }

        return $rules;
    }
}
