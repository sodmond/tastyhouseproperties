<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\Author;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $authClass = ['nullable', 'email', Rule::unique((new User)->getTable())->ignore(auth()->id())];
        if (Auth::getDefaultDriver() == 'admin') {
            $authClass = ['required', 'email', Rule::unique((new Admin)->getTable())->ignore(auth()->id())];
        }
        if (Auth::getDefaultDriver() == 'seller') {
            $authClass = ['nullable', 'email', Rule::unique((new Seller)->getTable())->ignore(auth()->id())];
        }
        return [
            'firstname' => ['required', 'min:3', 'max:255'],
            'lastname' => ['required', 'min:3', 'max:255'],
            'email' => $authClass,
        ];
    }
}
