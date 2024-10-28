<?php

namespace App\Livewire\Bookmarks;

use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class BookmarkList extends Component
{
    use WithPagination;

    public function render()
    {
        $links = Link::query()
            ->whereUser(Auth::id())
            ->wherePinned()
            ->latest()
            ->paginate(25);

        return view('livewire.bookmarks.bookmark-list', compact('links'));
    }
}
