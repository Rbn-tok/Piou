<?php

namespace App\Livewire\Feed;

use App\Jobs\FeedProcessor;
use App\Models\Feed;
use App\Services\Feed\Contracts\FeedReaderInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;

class NewForm extends Component
{
    public string $url;

    public string $name;

    public function save()
    {
        $input = $this->validate();

        $payload = [
            'user_id' => Auth::id(),
            'url' => trim($input['url']),
            'name' => $input['name'],
        ];

        $feed = Feed::create($payload);

        FeedProcessor::dispatch($feed);

        session()->flash('success', __(':feed a été ajouté avec succès', [
            'feed' => $feed->name,
        ]));

        return to_route('feeds.index');
    }

    public function render()
    {
        return view('livewire.feed.new-form');
    }

    public function rules()
    {
        return [
            'url' => [
                'required',
                'url',
                Rule::unique('feeds', 'url')
                    ->where(fn (Builder $query) => $query->where('user_id', Auth::id())),
            ],
            'name' => [
                'required',
                'string',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __("Nous n'arrivons pas à acceder au lien indiqué."),
        ];
    }

    protected function prepareForValidation($attributes)
    {
        try {
            $reader = App::make(FeedReaderInterface::class);
            /** @var Feed */
            $entity = $reader->about($attributes['url']);
            $attributes['name'] = $entity->name;
        } catch (\Throwable $th) {
            Log::warning(
                sprintf('%s ne peut identifier son nom : %s', $this->url, $th->getMessage()),
                $th->getTrace()
            );
        }

        return $attributes;
    }
}
