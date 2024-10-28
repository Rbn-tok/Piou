@extends('layouts.main')

@section('page-pretitle')
{{ __('Tableau de bord')}}
@endsection

@section('page-title')
{{ __("Nos liens" )}}
@endsection

@section('tags')
<a href="{{ route('tags.list') }}" class="btn btn-outline"> 
  {{ __('Tags') }} <i class="ti ti-tags ms-2"></i> 
</a>    
@endsection

@section('favoris')
<a href="{{ route('articles.favoris') }}" class="btn btn-outline"> 
  {{ __('Favoris') }} <i class="ti ti-star-filled ms-2"></i> 
</a>
@endsection

@section('page-btn-list')
<a href="{{ route('feeds.index') }}" class="btn btn-primary">
    <i class="ti ti-rss me-2 icon"></i> {{ __('Gérer les abonnements') }}
</a>
@endsection

@section('page-body')
<div class="card mb-3">
  <div class="card-body">
      <div class="divide-y">
          @foreach($links as $link)
          <div>
              <div class="row">
                <div class="col-1  align-self-center px-3">
                  <img src=" 
                              @if (!empty($link->image))
                                {{ $link->image }}
                              @else 
                                {{ __('https://us.123rf.com/450wm/mingirov/mingirov1904/mingirov190400262/120688657-ic%C3%B4ne-rss-isol%C3%A9e-sur-fond-gris-signal-radio-symbole-de-flux-rss-conception-plate-illustration.jpg?ver=6') }}
                              @endif
                            " class="card-img" alt="..."
                      >
                </div>
                <div class="col">
                  <h3>
                    <a href="{{ $link->url }}" target="_blank">
                      {{ $link->title }}
                    </a>
                  </h3>
                  <div class="mt-4 list-inline list-inline-dots mb-0 text-muted d-sm-block d-none">
                      <div class="list-inline-item">{{ $link->feed->name }}</div>
                      <div class="list-inline-item">{{ $link->published_at->diffForHumans()}}</div>
                      <div class="list-inline-item d-inline-flex align-items-center">
                        <form action="{{ route('articles.favori.toggle', $link) }}" method="POST">
                          @csrf
                          <button  class="btn-link text-muted p-0" type="submit">
                              @if ($link->favori)
                                {{ __('Enlever à vos favoris') }}
                              @else
                                {{ __('Ajouter aux favoris') }}
                              @endif
                          </button>
                        </form>
                      </div>
                      <div class="list-inline-item">
                        <a href="{{ route('pocket.add', $link) }}" class="text-muted">
                          {{ __('Ajouter à Pocket') }}
                        </a>

                      </div>
                  </div>
                  <div class="text-muted"></div>
                </div>
                <div class="col-auto mb-1 text-muted d-sm-block d-none align-self-end">
                    @foreach ($link->tags as $tag)
                      <li class="btn btn-pill px-2 py-1"><a class="{{ $clickedTag->id == $tag->id ? 'link-warning'  : 'link-secondary'}}" href="{{ route('tag.show', $tag) }}">{{ $tag->name }}</a></li>
                    @endforeach
                </div>
              </div>
          </div>
          @endforeach
      </div>
  </div><!-- .card-body -->
  <div class="card-footer d-flex align-items-center">
      {{ $links->links() }}
  </div><!-- .card-footer -->
</div><!-- .card -->
@endsection
