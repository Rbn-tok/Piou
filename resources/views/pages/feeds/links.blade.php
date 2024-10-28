@extends('layouts.main')

@section('page-pretitle')
    {{ __('Abonnements') }}
@endsection

@section('page-title')
    {{ $feed->name }}
@endsection

@section('page-body')
    @if ($links->isNotEmpty())
        <x-link.list :links="$links">
        </x-link.list>
    @else
        <x-empty-result title="Le Calme avant la tempête">
            <p class="mb-2">{{ __("La source est calme pour le moment, mais la tempête d'articles approche !") }}</p>
            <p class="mb-2">{{ __("Restez à l'affût pour de nouvelles publications. D'ici là, pourquoi ne pas consulter nos autres contenus ?") }}
        </x-empty-result>
    @endif
@endsection
