<div class="nav-link px-0 me-2">
    <button class="shadow-none border-0 bg-transparent" data-bs-target="#feed-modal" data-bs-toggle="modal" title="{{ __('Add a new subscription') }}" type="button">
        <i class="ti ti-plus icon"></i>
    </button>
    <form class="modal" data-bs-backdrop="static" data-bs-keyboard="true" id="feed-modal" method="POST" tabindex="-1" wire:ignore.self wire:submit.prevent="save">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title text-center">{{ __('Add a new subscription') }}</h5>
                    <button aria-label="{{ __('Close') }}" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label" for="feed-url">{{ __('You must specify the link of your atom/rss') }}</label>
                    <input class="form-control @error('url') is-invalid @enderror" id="feed-url" name="url" placeholder="https://myfeed.com/feed.atom" required type="url" wire:model="url" />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @error('url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="modal-footer">
                    @csrf
                    <button class="btn" data-bs-dismiss="modal" type="button">{{ __('Cancel') }}</button>
                    <button class="btn btn-primary" type="submit">{{ __('Add') }}</button>
                </div>
            </div>
        </div>
    </form>

</div>
