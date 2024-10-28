@extends('layouts.main')

@section('page-body')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">
                <a href="{{ $link->url }}" target="_blank">
                    {{ $link->title }}
                </a>
            </h1>
        </div>

        @if (!empty($entry->thumbnail))
            <img alt="{{ $link->title }}" class="card-img-top" src="{{ $entry->thumbnail }}">
        @endif

        <div class="card-body">
            <div class="list-inline list-inline-dots mb-0 text-muted">
                <div class="list-inline-item">{{ $link->published_at->diffForHumans() }}</div>
                <div class="list-inline-item">
                    <a href="{{ route('feeds.show', $link->feed) }}">{{ $link->feed->name }}</a>
                </div>
                <div class="list-inline-item">
                    <a href="{{ $link->url }}" target="_blank">{{ __('Voir la source') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! $link->content !!}
        </div>
        <div class="card-footer">
            <button class="btn" id="link-{{ $link->id }}-back" type="button">
                <i class="ti ti-arrow-left icon me-2"></i> {{ __('Revenir à la page précédente') }}
            </button>
        </div>
    </div>
@endsection

@push('body:end')
    <script>
        document
            .addEventListener('DOMContentLoaded', function() {
                document
                    .getElementById("link-{{ $link->id }}-back")
                    .addEventListener("click", () => {
                        history.back()
                    })
            })
    </script>
@endpush
