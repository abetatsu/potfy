<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoryRequest extends FormRequest
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
            'story_type'  => 'not_in: 0',
            'story'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'story_type.not_in'  => trans('validation.not_in'),
            'story.required'     => trans('validation.required'),
        ];
    }
}
