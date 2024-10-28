<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'exists:users,email',
            ],
            'password' => [
                'required',
                'string',
            ],
            'remember' => [
                'sometimes',
                'accepted',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('Indiquez votre adresse email'),
            'email.email' => __('Indiquez une adresse email correct'),
            'email.exists' => __("Indiquez une adresse email d'un compte existant"),
            'password.required' => __('Indiquez votre mot de passe'),
            'password.string' => __('Indiquez votre mot de passe'),
            'remember.accepted' => __("Voulez-vous qu'on se souvienne de vous ?"),
        ];
    }
}
