@if ($errors->any())
<div {{ $attributes->merge(['class' => 'alert alert-danger  my-0']) }}>
    <div class="d-flex justify-content-between align-items-center">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            @if (!str_contains($error, 'utility-error'))
                <li>{!! $error !!}</li>
            @endif
            @endforeach
        </ul>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('Close')}}"></a>
    </div>
</div>
@endif
