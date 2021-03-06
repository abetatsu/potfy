<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioRequest extends FormRequest
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
            'title'        => 'required|max:20',
            'description'  => 'required',
            'link'         => 'nullable|active_url',
            'image'        => 'mimes:jpeg,jpg,png,gif|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'title.required'       => trans('validation.required'),
            'title.max'            => trans('validation.max'),
            'description.required' => trans('validation.required'),
            'link.nullable'        => trans('validation.nullable'),
            'link.active_url'      => trans('validation.active_url'),
            'image.mimes'          => trans('validation.mimes'),
            'image.max'            => trans('validation.max'),
        ];
    }
}
