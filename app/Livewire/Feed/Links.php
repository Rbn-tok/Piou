<?php

namespace App\Livewire\Feed;

use App\Models\Feed;
use App\Models\Link;
use Livewire\Component;
use Livewire\WithPagination;

class Links extends Component
{
    use WithPagination;

    public Feed $feed;

    public function render()
    {
        $links = Link::query()
            ->where('feed_id', $this->feed->id)
            ->orderBy('published_at', 'desc')
            ->paginate(25);

        return view('livewire.feed.links', compact('links'));
    }
}
