@extends('layouts.main')

@section('page-pretitle')
{{ __('Tableau de bord')}}
@endsection

@section('page-title')
{{ __("Liste Tags") }}
@endsection

@section('page-btn-list')
<a href="{{ route('home') }}" class="btn btn-outline-primary">
    <i class="ti ti-arrow-left icon"></i> {{ __('Retour aux liens') }}
</a>
@endsection

@section('page-body')
<div class="card mb-3">
    <div class="card-body">
        <div class="divide-y">
            <div class="col-auto mb-1 text-muted d-sm-block d-none align-self-end">
                @foreach ($tags as $tag)
                  <li class="btn btn-pill px-3 py-1 m-2"><a class="link-secondary" href="{{ route('tag.show', $tag) }}">{{ $tag->name }}</a></li>
                @endforeach
            </div>
        </div>
    </div><!-- .card-body -->
    <div class="card-footer d-flex align-items-center">
        {{ $tags->links() }}
    </div><!-- .card-footer -->
</div><!-- .card -->
@endsection