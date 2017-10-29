<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateEditRequest extends FormRequest
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
            'title' => 'required|min:2|max:255',
            'body' => 'required|min:2',
            'tags' => 'array',
        ];
    }

    public function messages()
    {
        return [
            'tags.array' => 'Please change the select back to an array.',
            'tags.*'  => 'Please select a valid tag',
        ];
    }
}
