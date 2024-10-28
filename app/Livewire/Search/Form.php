<?php

namespace App\Livewire\Search;

use App\Models\Link;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Form extends Component
{
    #[Validate('required|min:3')]
    public ?string $search = '';

    public function render()
    {
        $links = collect();

        if (!empty($this->search)) {
            $links = Link::query()
                ->search($this->search)
                ->paginate(25);
        }

        return view('livewire.search.form', compact('links'));
    }
}
