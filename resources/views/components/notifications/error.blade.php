@if (session('error'))
<div {{ $attributes->merge(['class' => 'alert alert-danger my-0']) }}>
    <div class="d-flex justify-content-between align-items-center">
        {!! session('error') !!}
        <a class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('Close')}}"></a>
    </div>
</div>
@endif
