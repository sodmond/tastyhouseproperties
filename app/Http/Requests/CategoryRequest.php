<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'         => ['required', 'string', 'max:255'], 
            'level'         => ['required', 'integer'],
            'parent'        => ['required_if:level,2', 'required_if:level,3', 'integer'], 
            'icon'          => ['nullable', 'string', 'max:255'], 
            'description'   => ['nullable', 'string', 'max:1000']
        ];
    }
}
