@extends('layouts.main', [
    'hasPageHeader' => true,
])

@section('page-pretitle')
    {{ __('La crème de la crème') }}
@endsection

@section('page-title')
    {{ __('Les nouvelles du jour') }}
@endsection

@section('page-body')
    @if ($links->isNotEmpty())
        <x-link.list :links="$links" :markAsRead="true"></x-link.list>
    @else
        <x-empty-result title="Exploration quotidienne terminée !">
            <p class="mb-2">{{ __('Félicitations, vous avez exploré tous les trésors du jour !') }}</p>
            <p class="mb-2">{{ __("Mais ne vous inquiétez pas, demain est un nouveau jour pour découvrir encore plus d'articles passionnants.") }}</p>
            <p class="mb-4">{{ __("En attendant, pourquoi ne pas jeter un coup d'oeil aux pépites d'hier ?") }}</p>
            <a class="btn btn-primary" href="{{ route('yesterday') }}">{{ __("Voir les articles d'hier") }}</a>
        </x-empty-result>
    @endif
@endsection
