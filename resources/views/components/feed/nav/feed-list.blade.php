<div {{ $attributes }}>
    @foreach ($items as $item)
        <a class="dropdown-item" href="{{ route('feeds.show', $item) }}">
            {{ $item->name }}
        </a>
    @endforeach
</div>
