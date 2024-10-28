<?php

namespace App\Livewire\Link;

use App\Models\Feed;
use App\Models\Link;
use Livewire\Component;

class ListItem extends Component
{
    public Link $link;

    public Feed $feed;

    public function pin()
    {
        $this->link->pinned_at = now();
        $this->link->save();
    }

    public function unpin()
    {
        $this->link->pinned_at = null;
        $this->link->save();
    }

    public function render()
    {
        return view('livewire.link.list-item');
    }
}
