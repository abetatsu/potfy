<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'image.mimes'    => trans('validation.mimes'),
            'image.max'      => trans('validation.max'),
        ];
    }
}
