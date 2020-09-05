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
            'story'  => 'required',
            'story_type'  => 'not_in: 0',
        ];
    }

    public function messages()
    {
        return [
            'story.required'  => '内容は必須です。',
            'story_type.not_in'  => 'ストーリーを選択してください',
        ];
    }
}
