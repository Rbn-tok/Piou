@extends('layouts.login')

@section('contents')
    <form action="{{ route('login') }}" autocomplete="off" method="POST">

        <x-ack />
        <div class="mb-3">
            <label class="form-label" for="email">{{ __('Email') }}</label>
            <x-text-input :value="old('email')" autocomplete="email" autofocus class="form-control" id="email" name="email" required type="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mb-2">
            <label class="form-label" for="password">
                {{ __('Mot de passe') }}
                <span class="form-label-description">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">{{ __('I forgot password') }}</a>
                    @endif
                </span>
            </label>
            <div class="input-group input-group-flat">
                <x-text-input autocomplete="current-password" class="form-control" id="password" name="password" required type="password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>
        <div class="mb-2">
            <label class="form-check" for="remember_me">
                <input class="form-check-input" id="remember_me" name="remember" type="checkbox" />
                <span class="form-check-label">{{ __('Se souvenir de moi') }}</span>
            </label>
        </div>
        <div class="form-footer">
            @csrf
            <button class="btn btn-primary w-100" type="submit">{{ __('Se connecter') }}</button>
        </div>
    </form>
@endsection
