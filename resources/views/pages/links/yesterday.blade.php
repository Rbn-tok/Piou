@extends('layouts.main', [
    'hasPageHeader' => true,
])

@section('page-pretitle')
    {{ __('Rattrapage Express') }}
@endsection

@section('page-title')
    {{ __("Récapitulatif de l'actualité d'hier") }}
@endsection

@section('page-body')
    @if ($links->isNotEmpty())
        <x-link.list :links="$links" :markAsRead="true"></x-link.list>
    @else
        <x-empty-result title="Découverte d'hier terminée !">
            <p class="mb-2">{{ __("Vous avez exploré toutes les pépites d'hier, bravo !") }}</p>
            <p class="mb-4">{{ __('Mais il y a encore plus à découvrir. Pourquoi ne pas plonger dans les trésors de la semaine ? ') }}</p>
            <a class="btn btn-primary " href="{{ route('week') }}">
                {{ __('Voir les articles de la semaine') }}
            </a>
        </x-empty-result>
    @endif
@endsection
