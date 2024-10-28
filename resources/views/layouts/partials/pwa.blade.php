<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="{{ csrf_token() }}" name="csrf-token">
<title>{{ config('app.name') }}</title>
<link href="{{ asset('/images/favicon.ico') }}" rel="icon">
<link href="{{ asset('/images/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
<meta content="#ffffff" name="theme-color">
<script src="{{ asset('/build/registerSW.js') }}"></script>
<link href="{{ asset('/build/manifest.webmanifest') }}" rel="manifest" />
