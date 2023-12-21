<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubpageRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Only allow logged-in users to create a subpage
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // The name of the subpage is required, must be unique in the 'subpages' table, and not exceed 255 characters
            'name' => 'required|unique:subpages,name|max:255',

            // The description is optional but must not exceed 1000 characters
            'description' => 'nullable|max:1000'
        ];
    }

    /**
     * Custom messages for validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The name of the subpage is required.',
            'name.unique' => 'This subpage name has already been taken.',
            'name.max' => 'The subpage name may not be greater than 255 characters.',
            'description.max' => 'The description may not be greater than 1000 characters.',
        ];
    }
}
