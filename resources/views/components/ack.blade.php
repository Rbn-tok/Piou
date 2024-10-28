@if ($errors->any())
  <div class="alert alert-danger mb-3">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        @if (!str_contains($error, 'utility-error'))
          <li>{!! $error !!}</li>
        @endif
      @endforeach
    </ul>
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger mb-3">
    {!! session('error') !!}
  </div>
@endif

@if (session('success'))
  <div class="alert alert-success mb-3">
    {!! session('success') !!}
  </div>
@endif

@if (session('info'))
  <div class="alert alert-info mb-3">
    {!! session('info') !!}
  </div>
@endif
