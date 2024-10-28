<?php

namespace App\Livewire\Link;

use App\Models\Link;
use Livewire\Component;

class Show extends Component
{
    public Link $link;

    public function mount(Link $link)
    {
        $this->link = $link;

        if (!$this->link->read_at) {
            $this->link->update([
                'read_at' => now(),
            ]);
        }
    }

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
        return view('livewire.link.show');
    }
}
