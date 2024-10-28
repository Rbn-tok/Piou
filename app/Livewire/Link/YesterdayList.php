<?php

namespace App\Livewire\Link;

use App\Helpers\Link;
use Livewire\Component;
use Livewire\WithPagination;

class YesterdayList extends Component
{
    use WithPagination;
    use Link;

    public function render()
    {
        $links = $this->getLinks(
            now()->subDays(1)->startOfDay(),
            now()->startOfDay()
        );

        return view('livewire.link.yesterday-list', compact('links'));
    }
}
