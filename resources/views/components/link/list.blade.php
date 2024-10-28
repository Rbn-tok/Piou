<div>

    <div class="row mb-3">
        <div class="col">
            @foreach ($links as $link)
                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="mb-1"><a href="{{ route('links.show', $link) }}">{{ $link->title }}</a></h3>
                        <div class="list-inline list-inline-dots mb-0 text-muted">
                            <div class="list-inline-item">

                                <span class="d-inline d-md-none">{{ $link->published_at->format('H\hi') }}</span>
                                <span class="d-none d-md-inline">{{ $link->published_at->diffForHumans() }}</span>
                            </div>
                            <div class="list-inline-item">
                                <a href="{{ route('feeds.show', $link->feed) }}">{{ $link->feed->name }}</a>
                            </div>
                            <div class="list-inline-item">
                                <a class="text-decoration-none" href="{{ $link->url }}" target="_blank">
                                    <i class="d-inline d-md-none ti ti-external-link me-2"></i>
                                    <span class="d-none d-md-inline">{{ __('Voir la source') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col">
            {{ $links->links() }}
        </div>

        @if ($links->isNotEmpty() && isset($markAsRead) && $markAsRead)
            <div class="col text-end">
                <x-link.marklist-as-read :links="$links">
                </x-link.marklist-as-read>
            </div>
        @endif
    </div>
</div>

@push('page-btn-list')
    @if ($links->isNotEmpty() && isset($markAsRead) && $markAsRead)
        <x-link.marklist-as-read :links="$links"></x-link.marklist-as-read>
    @endif
@endpush
