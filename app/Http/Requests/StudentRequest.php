<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Return true if all authenticated users are allowed to make this request.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string|array>
     */
    public function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'gender' => 'nullable|in:male,female,rather_not_to_say',
            'email' => 'nullable|email|unique:students,email',
            'address' => 'nullable|string|max:255',
            'phonenumber' => 'nullable|string|max:20',

            'university' => 'nullable|string|max:255',
            'degree' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:255',
            'major' => 'nullable|string|max:255',

            'experience_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array<string, string>
     */
    // public function messages()
    // {
    //     return [
    //         'full_name.required' => 'The full name is required.',
    //         'birthday.required' => 'The birthday is required.',
    //         'email.email' => 'The email must be a valid email address.',
    //         'email.unique' => 'The email has already been taken.',
    //         'gender.in' => 'The gender must be either male, female, or rather not to say.',
    //         // Add custom messages for other fields if necessary
    //     ];
    // }
}
