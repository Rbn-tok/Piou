@extends('layouts.main', [
    'hasPageHeader' => true,
])

@section('page-pretitle')
    {{ __('Vos résultats pour') }}
@endsection

@section('page-title')
    {{ $term }}
@endsection

@section('page-body')
    @if ($links->isNotEmpty())
        <x-link.list :links="$links"></x-link.list>
    @else
        <x-empty-result title="Rien ici, à part des pixels perdus !">
            <p class="mb-1">{{ __("Oops ! On dirait que cette recherche est plus secrète que les plans d'une licorne. ") }}</p>
            <p class="mb-2">{{ __('Essayez quelque chose de différent et laissez-nous démêler ce mystère pour vous ! ') }}</p>
        </x-empty-result>
    @endif
@endsection
