<?php

namespace App\Http\Requests\Feed;

use App\Models\Feed;
use App\Models\User;
use App\Services\Feed\Contracts\FeedReaderInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        /** @var User */
        $user = $this->user();

        return [
            'url' => [
                'required',
                'url',
                Rule::unique('feeds', 'url')
                    ->where(fn (Builder $query) => $query->where('user_id', $user->id)),
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
            'name.required' => __('Vérifiez que votre lien est toujours actif et valide au format RSS/Atom'),
            'name.string' => __('Vérifiez que votre lien est toujours actif et valide au format RSS/Atom'),
        ];
    }

    protected function prepareForValidation()
    {
        $payload = [
            'user_id' => $this->user()->id,
        ];

        if ($this->filled('url')) {
            try {
                $reader = App::make(FeedReaderInterface::class);
                /** @var Feed */
                $entity = $reader->about($this->input('url'));
                $payload['name'] = $entity->name;
                $payload['url'] = trim($this->input('url'));
            } catch (\Throwable $th) {
            }
        }

        $this->merge($payload);
    }
}
