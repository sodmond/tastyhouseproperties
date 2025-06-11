<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
            'new'           => ['required', 'numeric'],
            'title'         => ['required', 'string', 'max:255'],
            'image'         => ['nullable', 'required_if_accepted:new', 'image', 'mimes:jpg,png,jpeg', 'max:512', Rule::dimensions()->width(900)->height(600)],
            'published_at'  => ['required', 'date'],
            'description'   => ['required']
        ];
    }
}
