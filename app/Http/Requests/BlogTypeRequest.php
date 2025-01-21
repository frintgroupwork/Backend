<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Allow all users to make the request
    }

    public function rules()
    {
        return [
            'type_name' => 'string|max:255', // Validation rules for the field
        ];
    }
}
