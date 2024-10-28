<form action="{{ route('links.mark-list-as-read') }}" class="row" method="POST">
    <div class="col">
        @csrf
        @method('patch')
        <input name="read" type="hidden" value="{{ encrypt(implode(',', $links->pluck('id')->all())) }}">
        <div class="d-flex justify-content-end flex-fill d-sm-none">
            <button class="btn btn-primary btn-icon">
                <i class="ti ti-checks icon"></i>
            </button>
        </div>
        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-end">
            <button class="btn btn-primary">
                <i class="ti ti-checks me-2 icon"></i>
                <span class="">{{ __('Mark as read') }}</span>
            </button>
        </div>
    </div>
</form>
