<div {{ $attributes }}>
    <button class="nav-link px-0" data-bs-target="#search-modal" data-bs-toggle="modal" title="{{ __('Search') }}" type="button">
        <i class="ti ti-search icon"></i>
    </button>
    <form action="{{ route('search.index') }}" class="modal" data-bs-backdrop="static" data-bs-keyboard="true" id="search-modal" method="GET" tabindex="-1">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title text-center">{{ __('Recherche') }}</h5>
                    <button aria-label="{{ __('Close') }}" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control @error('url') is-invalid @enderror" name="q" placeholder="Ex: PHP" required type="text" value="{{ old('q') }}" />
                </div>

                <div class="modal-footer">
                    <button class="btn" data-bs-dismiss="modal" type="button">{{ __('Cancel') }}</button>
                    <button class="btn btn-primary" type="submit">{{ __('Rechercher') }}</button>
                </div>
            </div>
        </div>
    </form>

</div>
