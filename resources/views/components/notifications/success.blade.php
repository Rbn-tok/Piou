@if (session('success'))
<div {{ $attributes->merge(['class' => 'alert alert-success my-0']) }}>
    <div class="d-flex justify-content-between align-items-center">
        {!! session('success') !!}
        <a class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('Close')}}"></a>
    </div>
</div>
@endif
