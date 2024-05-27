<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'name' => 'required|unique:projects,name|min:5|max:100',
            'technologies' => 'exists:technologies,id',
            //'slug' => 'required|min:5|max:100',
            'type_id' => 'nullable|exists:types,id',
            'link' => 'nullable|min:15|max:255',
            'link_code' => 'nullable|min:15|max:255',
            'cover_image' => 'nullable|image|max:500',
            'project_date' => 'nullable',
        ];
    }
}
