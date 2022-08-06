<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rules\Password;

class NewUserRequest extends AbstractApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100'
            ],
            'email' => 'required|string|email|max:50|unique:users,email',
            'password' => [
                'required', 'string', 'max:50', 'confirmed',
                Password::min(8),
            ],
        ];
    }
}
