<?php

namespace App\View\Components\Feed\Nav;

use App\Models\Feed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class FeedList extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|\Closure|string
    {
        $items = Feed::query()
            ->whereUser(Auth::user())
            ->get();

        return view('components.feed.nav.feed-list', compact('items'));
    }
}
