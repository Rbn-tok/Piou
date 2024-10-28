@extends('layouts.main')

@section('page-body')
    <x-notifications.success class="mb-3"></x-notifications.success>

    <div class="card mb-3">
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <th>{{ __('Subscription') }}</th>
                    <th class="text-end"></th>
                </thead>
                <tbody>
                    @foreach ($feeds as $feed)
                        <tr>
                            <td>
                                {{ $feed->name }}
                                <a class="text-muted d-block" href="{{ $feed->url }}">{{ $feed->url }}</a>
                                <div class="text-muted d-block">{{ $feed->checked_at ? __('Mis à jour le :date', ['date' => $feed->checked_at->format('d/m/ H:i')]) : __('Jamais mis à jour') }}</div>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end">
                                    <form action="{{ route('feeds.sync', $feed) }}" class="me-3" method="POST">
                                        @csrf
                                        <button class="btn btn-default btn-icon">
                                            <i class="ti ti-refresh icon"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('feeds.delete', ['feed' => $feed]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-icon">
                                            <i class="ti ti-trash icon"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- .table-responsive -->
        <div class="card-footer d-flex align-items-center">
            {{ $feeds->links() }}
        </div><!-- .card-footer -->
    </div><!-- .card -->
@endsection
