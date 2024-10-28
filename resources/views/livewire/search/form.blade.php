<div class="nav-link px-0 me-2">
    <button class="shadow-none border-0 bg-transparent" data-bs-target="#search-modal" data-bs-toggle="modal" title="{{ __('Search a link') }}" type="button">
        <i class="ti ti-search icon"></i>
    </button>
    <form class="modal" data-bs-backdrop="static" data-bs-keyboard="true" id="search-modal" method="POST" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <div class="w-100">

                        <div class="form-group">
                            <div class="input-icon">
                                <input class="form-control" name="q" placeholder="Recherche ... " type="text" value="" wire:model.live="search">
                                <span class="input-icon-addon">
                                    <svg class="icon" fill="none" height="24" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none" stroke="none"></path>
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                        <path d="M21 21l-6 -6"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <button aria-label="{{ __('Close') }}" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            @if ($links->isNotEmpty())
                                @foreach ($links as $link)
                                    <livewire:link.list-item :feed="$link->feed" :link="$link" wire:key="{{ $link->id }}"></livewire:link.list-item>
                                @endforeach
                            @endif
                            @if ($links->isEmpty())
                                <x-empty-result>
                                    <p class="lead">{{ __('Veuillez effectuer une recherche.') }}</p>
                                </x-empty-result>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
