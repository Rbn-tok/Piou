<div class="card">
    <div class="card-header">
        <h1 class="card-title fw-bold">
            <a href="{{ $link->url }}" target="_blank">
                {{ $link->title }}
            </a>
        </h1>

    </div>
    @if (!empty($entry->thumbnail))
        <img alt="{{ $link->title }}" class="card-img-top" src="{{ $entry->thumbnail }}">
    @endif

    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="list-inline list-inline-dots mb-0 text-muted">
                    <div class="list-inline-item">{{ $link->published_at->diffForHumans() }}</div>
                    <div class="list-inline-item">
                        <a href="{{ route('feeds.show', $link->feed) }}">{{ $link->feed->name }}</a>
                    </div>
                    <div class="list-inline-item">
                        <a href="{{ $link->url }}" target="_blank">{{ __('Voir la source') }}</a>
                    </div>
                    <div class="list-inline-item">
                        @if ($link->isPinned)
                            <a class="text-decoration-none cursor-pointer" wire:click.prevent="unpin"><i class="ti ti-bookmark-filled icon"></i></a>
                        @else
                            <a class="text-decoration-none cursor-pointer" wire:click.prevent="pin"><i class="ti ti-bookmark icon"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <a class="text-decoration-none" href="{{ url()->previous() }}" id="link-{{ $link->id }}-back" wire:navigate>
                    <i class="ti ti-arrow-left icon"></i>
                </a>
            </div>

        </div>

    </div>
    <div class="card-body">
        {!! $link->content !!}
    </div>
    <div class="card-footer">
        <a class="btn" href="{{ url()->previous() }}" id="link-{{ $link->id }}-back" wire:navigate>
            <i class="ti ti-arrow-left icon me-2"></i> {{ __('Revenir à la page précédente') }}
        </a>
    </div>
</div>
