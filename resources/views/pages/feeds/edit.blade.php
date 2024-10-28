@extends('layouts.main')

@section('page-pretitle')
{{ __('Tableau de bord')}}
@endsection

@section('page-title')
{{ __("Abonnements") }}
@endsection

@section('page-btn-list')
<a href="{{ route('home') }}" class="btn btn-outline-primary">
    <i class="ti ti-arrow-left icon"></i> {{ __('Retour aux liens') }}
</a>
@endsection

@section('page-body')
    <form method="POST" action="{{ route('feeds.update', ['feed' => $feed]) }}" class="card mb-3">
        @csrf
        @method('PUT')

        <div class="card-body">
            <x-ack></x-ack>

            <div class="vstack gap-3">
                <div class="d-flex">
                    <label class="mt-2 me-2" for="name">{{ __('Nom:')}}</label>
                    <input class="form-control me-auto" type="text" name="name" value="{{ old('name', $feed->name ) }}">
                </div>
                <div class="d-flex">
                    <label class="mt-2 me-2" for="url">{{ __('Lien:')}}</label>
                    <input class="form-control me-auto" type="url" value="{{ old('url', $feed->url) }}" name="url" placeholder="{{ __("Ajouter l'adresse de votre flux") }}" aria-label="Ajouter l'adresse de votre flux" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-secondary">{{ __("Modifier") }}</button>
                    <button class="btn btn-success "><a href="{{ route('feeds.index') }}" class="text-decoration-none text-reset">Annuler</a></button>
                </div>
            </div>
            
        </div><!-- .card-body -->
    </form><!-- .card -->
@endsection