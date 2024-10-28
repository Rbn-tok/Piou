@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mes Flux RSS</h1>
    <ul class="list-group">
        @foreach($feedItems as $item)
            <li class="list-group-item">
                <a href="{{ $item['link'] }}">{{ $item['title'] }}</a>
                <p>{{ $item['description'] }}</p>
            </li>
        @endforeach
    </ul>
</div>
@endsection
