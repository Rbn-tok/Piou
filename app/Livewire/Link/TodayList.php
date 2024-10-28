<?php

namespace App\Livewire\Link;

use App\Helpers\Link as HelpersLink;
use Livewire\Component;
use Livewire\WithPagination;

class TodayList extends Component
{
    use WithPagination;
    use HelpersLink;

    public function render()
    {
        $links = $this->getLinks(now()->startOfDay());

        return view('livewire.link.today-list', compact('links'));
    }
}
