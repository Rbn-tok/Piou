<div>

    <div class="row mb-3">
        <div class="col">
            @if ($links->isNotEmpty())
                @foreach ($links as $link)
                    <livewire:link.list-item :feed="$link->feed" :link="$link" wire:key="{{ $link->id }}"></livewire:link.list-item>
                @endforeach
            @endif
            @if ($links->isEmpty())
                <x-empty-result>
                    <h2 class="mb-3">{{ $feed->name }}</h2>
                    <p class="lead">{{ __('Nous ne disposons pas de contenus pour cet abonnement.') }}</p>
                </x-empty-result>
            @endif
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col">
            {{ $links->links() }}
        </div>
    </div>
</div>
