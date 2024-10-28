<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('layouts.partials.pwa')
        @include('layouts.partials.metadata')
        @vite('resources/css/app.scss')
        @livewireStyles
        @stack('head:end')
    </head>

    <body>
        @stack('body:start')

        <div class="page">
            <header class="navbar navbar-expand-md d-print-none sticky-top">
                <div class="container-xl">
                    <button aria-controls="navbar-menu" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}" class="navbar-toggler" data-bs-target="#navbar-menu" data-bs-toggle="collapse" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                        <a href="{{ route('home') }}" style="min-height: 32px;min-width:64px" wire:navigate>
                            <img alt="{{ config('app.name') }}" class="navbar-brand-image" src="{{ asset('/images/logo_light.svg') }}">
                        </a>
                    </h1>
                    <div class="navbar-nav flex-row order-md-last">
                        <livewire:feed.new-form />
                        <livewire:search.form />

                        <div class="nav-item dropdown">
                            <a aria-label="{{ __('Menu') }}" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" href="/">
                                <span class="avatar avatar-sm shadow-none" style="background-image: url({{ asset('/images/logo_ico.svg') }})"></span>
                                <div class="d-none d-xl-block ps-2">
                                    <div>{{ auth()->user()->fullname }}</div>
                                    <div class="mt-1 small text-secondary">{{ auth()->user()->email }}</div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <a class="dropdown-item my-0" href="{{ route('feeds.index') }}">{{ __('Manage subscriptions') }}</a>
                                <div class="dropdown-divider my-0"></div>
                                <a class="dropdown-item my-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                            <form action="{{ route('logout') }}" id="logout-form" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                            <ul class="navbar-nav">
                                <li class="nav-item @if (request()->routeIs('home')) active @endif">

                                    <a class="nav-link" href="{{ route('home') }}" wire:navigate>
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <i class="ti ti-clock-24 icon"></i>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __("Aujourd'hui") }}
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item @if (request()->routeIs('yesterday')) active @endif">
                                    <a class="nav-link" href="{{ route('yesterday') }}" wire:navigate>
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <i class="ti ti-clock-play icon"></i>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Hier') }}
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item @if (request()->routeIs('week')) active @endif">
                                    <a class="nav-link" href="{{ route('week') }}" wire:navigate>
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <i class="ti ti-calendar-time icon"></i>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Cette semaine') }}
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item @if (request()->routeIs('bookmarks.*')) active @endif">
                                    <a class="nav-link" href="{{ route('bookmarks.index') }}" wire:navigate>
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <i class="ti ti-bookmarks icon"></i>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Signets') }}
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown @if (request()->routeIs('feeds.*')) active @endif">
                                    <a aria-expanded="false" class="nav-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown" href="#navbar-base" role="button">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <i class="ti ti-rss icon"></i>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Abonnements') }}
                                        </span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-columns">
                                            <x-feed.nav.feed-list class="dropdown-menu-column"></x-feed.nav.feed-list>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <div class="page-wrapper">
                @if (isset($hasPageHeader) && $hasPageHeader)
                    <div class="page-header d-print-none">
                        <div class="container-xl">
                            <div class="row g-2 align-items-center">
                                <div class="col">
                                    @hasSection('page-pretitle')
                                        <div class="page-pretitle">
                                            @yield('page-pretitle')
                                        </div>
                                    @endif

                                    @hasSection('page-title')
                                        <h2 class="page-title">@yield('page-title')</h2>
                                    @endif
                                </div>

                                <div class="col-auto ms-auto d-print-none btn-list">
                                    <div class="btn-list">
                                        @stack('page-btn-list')
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><!-- .page-header -->
                @endif

                <div class="page-body">
                    <div class="container-xl">
                        {{ $slot }}
                    </div><!-- .container-xl -->
                </div><!-- .page-body -->
            </div><!-- .page-wrapper -->
        </div><!-- .page -->

        @vite('resources/js/app.js')
        @livewireScripts
        @stack('body:end')
    </body>

</html>
