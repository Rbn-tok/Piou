@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-start flex-fill d-sm-none">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button @disabled(true) class="btn me-2 btn-outline-primary btn-icon" type="button"><i class="ti ti-chevrons-left icon"></i></button>
            @else
                <a class="btn me-2 btn-outline-primary btn-icon" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="ti ti-chevrons-left icon"></i></a>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="btn btn-outline-primary btn-icon" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="ti ti-chevrons-right icon"></i></a>
            @else
                <button @disabled(true) class="btn btn-outline-primary btn-icon" type="button"><i class="ti ti-chevrons-right icon"></i></span>
            @endif
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-start">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button @disabled(true) aria-hidden="true" class="btn disabled  mx-1" type="button">&lsaquo;</button>
            @else
                <a aria-label="{{ __('Previous') }}" class="btn  mx-1" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <button @disabled(true) aria-hidden="true" class="btn disabled  mx-1" type="button">{{ $element }}</button>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class="btn btn-primary  mx-1" type="button">{{ $page }}</button>
                        @else
                            <a class="btn  mx-1" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a aria-label="{{ __('Next') }}" class="btn" href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
            @else
                <button @disabled(true) aria-hidden="true" class="btn" type="button">&rsaquo;</button>
            @endif
        </div>
    </nav>
@endif
