<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $post = Post::where('title', $this->title_original)->first();
        
        switch ($this->method()) {
            case 'POST':
                return [    
                    'title' => [
                        'required',
                        'min:2',
                        'max:255',
                        'unique:posts'
                    ],
                    'body' => 'required|min:2',
                    'tags' => 'array'
                ];
                break;

            case 'PATCH':
                return [
                    'title' => [
                        'required',
                        'min:2',
                        'max:255',
                        Rule::unique('posts')->ignore($post->id)
                    ],
                    'body' => 'required|min:2',
                    'tags' => 'array'
                ];
                break;
            
            default:
                # code...
                break;
        }
    }
}
