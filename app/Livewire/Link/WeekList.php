<?php

namespace App\Livewire\Link;

use App\Helpers\Link;
use Livewire\Component;
use Livewire\WithPagination;

class WeekList extends Component
{
    use WithPagination;
    use Link;

    public function render()
    {
        $links = $this->getLinks(
            now()->subWeek()->startOfDay(),
            now()->subDays(2)->startOfDay()
        );

        return view('livewire.link.week-list', compact('links'));
    }
}
