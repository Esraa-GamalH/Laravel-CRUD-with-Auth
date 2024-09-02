<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\MaxPostsForUser;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:255|unique:posts,title',
            'description' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author_id' => [
                'required',
                'exists:authors,id', // Ensure the author exists in the database
            ],
            'createdAt' => 'required|date',
            new MaxPostsForUser,
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please Enter a title for created post',
            'title.unique' => 'This title is already exists',
            'description.required' => 'Please provide a description for created post',
            'image.image' => 'The file must be an image (jpeg, png, bmp, gif, svg, or webp).',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image must not be larger than 2MB.',
            'author_id.exists' => 'The selected author does not exist',
        ];
    }
}
