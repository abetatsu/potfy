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
            'image.mimes'    => 'ファイルタイプをjpeg,jpg,png,gifに設定してください。',
            'image.max'      => 'ファイルサイズを10MB以下に設定してください。',
        ];
    }
}
