<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('layouts.partials.pwa')
        @include('layouts.partials.metadata')
        @vite('resources/css/app.scss')
    </head>

    <body class=" d-flex flex-column">
        <div class="page page-center">
            <div class="container container-tight py-4">
                <div class="text-center mb-4">
                    <a class="navbar-brand navbar-brand-autodark" href=".">
                        <img alt="{{ config('app.name') }}" class="navbar-brand-image" src="{{ asset('/images/logo_dark.svg') }}">
                    </a>
                </div>
                <div class="card card-md">
                    <div class="card-body">
                        @yield('contents')
                    </div>
                </div>
            </div>
        </div>
    </body>

    @vite('resources/js/app.js')
    </body>

</html>
