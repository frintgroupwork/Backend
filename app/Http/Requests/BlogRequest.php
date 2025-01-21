<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the uploaded image
            'date' => 'required|date',
            'blog_type_id' => 'required|exists:blog_types,id',
            'source' => 'nullable|url', // Validate the source as a URL

        ];
    }
}
