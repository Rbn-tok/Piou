<div class="empty">
    <div class="empty-img"><img alt="" height="128" src="/images/floating.svg"></div>

    @if (isset($title) && !empty($title))
        <div class="empty-title">{{ __($title ?? '') }}</div>
    @endif

    <div class="empty-subtitle text-muted">
        {{ $slot }}
    </div>
</div>
