@extends('layouts.main', [
    'hasPageHeader' => true,
])

@section('page-pretitle')
    {{ __('Édition Hebdomadaire') }}
@endsection

@section('page-title')
    {{ __("L'essentiel de la semaine") }}
@endsection

@section('page-body')
    @if ($links->isNotEmpty())
        <x-link.list :links="$links" :markAsRead="true"></x-link.list>
    @else
        <x-empty-result title="Noyau de connaissance épuisé">
            <p class="mb-2">{{ __('Félicitations, explorateur de la semaine ! Vous avez découvert tous les articles disponibles.') }}</p>
            <p class="mb-4">{{ __('Pour une plongée plus approfondie, rendez-vous sur chaque source.') }}</p>
        </x-empty-result>
    @endif
@endsection
