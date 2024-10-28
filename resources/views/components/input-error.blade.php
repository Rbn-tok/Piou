@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <span {{ $attributes->merge(['class' => 'invalid-feedback']) }}>
        {{ $message }}
        </span>
    @endforeach
@endif
