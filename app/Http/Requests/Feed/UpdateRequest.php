<?php

namespace App\Http\Requests\Feed;

use App\Models\Feed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        /** @var Feed */
        $feed = $this->route('feed');

        return [
            'url' => [
                'required',
                'url',
                Rule::unique('feeds', 'url')->ignore($feed->id),
            ],
            'name' => [
                'required',
                'string',
            ],
            'user_id' => [
                'required',
                'exists:users,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'url.required' => __('Indiquez le lien de votre abonnement'),
            'url.url' => __('Indiquez le lien de votre abonnement'),
            'url.unique' => __('Vous etes déjà abonnés à ce site'),
        ];
    }

    protected function prepareForValidation()
    {
        $payload = [
            'user_id' => $this->user()->id,
            'name' => $this->input('name'),
            'url' => $this->input('url'),
        ];

        $this->merge($payload);
    }
}
