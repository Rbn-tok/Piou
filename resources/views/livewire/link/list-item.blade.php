<div class="card card-sm mb-2">
    <div class="card-body">
        <h3 class="card-title fw-bold text-dark"><a href="{{ route('links.show', $link) }}" wire:navigate>{{ $link->title }}</a></h3>
        <div class="row">
            <div class="col">
                <div class="list-inline list-inline-dots mb-0 text-muted">
                    <div class="list-inline-item">
                        <span class="d-inline d-md-none">{{ $link->published_at->format('H\hi') }}</span>
                        <span class="d-none d-md-inline">{{ $link->published_at->diffForHumans() }}</span>
                    </div>
                    <div class="list-inline-item">
                        <a href="{{ route('feeds.show', $feed) }}" wire:navigate>{{ $feed->name }}</a>
                    </div>
                    <div class="list-inline-item">
                        <a class="text-decoration-none" href="{{ $link->url }}" rel="noreferrer" target="_blank">
                            <i class="d-inline d-md-none ti ti-external-link me-2"></i>
                            <span class="d-none d-md-inline">{{ __('Voir la source') }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-auto">
                @if ($link->isPinned)
                    <a class="text-decoration-none cursor-pointer" wire:click.prevent="unpin"><i class="ti ti-bookmark-filled icon"></i></a>
                @else
                    <a class="text-decoration-none cursor-pointer" wire:click.prevent="pin"><i class="ti ti-bookmark icon"></i></a>
                @endif
            </div>
        </div>
    </div>
</div>
