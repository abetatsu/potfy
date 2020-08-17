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
            'title' => 'required|max:20',
            'description'=>'required',
            'link'=>'required',
        ];
    }

    public function messages()
    {
        return [
        'title.required' => trans('validation.required'),
        'title.max'      => trans('validation.max'),
        'description.required'  => trans('validation.required'),
        'link.required'=> trans('validation.required'),
    ];
    }
}
