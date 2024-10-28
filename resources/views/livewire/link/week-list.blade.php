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
                    <p class="lead">{{ __('Nous ne disposons pas de contenus cette semaine.') }}</p>
                </x-empty-result>
            @endif
        </div>
    </div>

    <div class="row align-items-center">
        <div class="col">
            {{ $links->links() }}
        </div>

        @if ($links->isNotEmpty() && isset($markAsRead) && $markAsRead)
            <div class="col text-end">
                <x-link.marklist-as-read :links="$links"></x-link.marklist-as-read>
            </div>
        @endif
    </div>
</div>
