<?php

namespace App\Http\Livewire;

use App\Models\Author;
use Livewire\Component;
use Livewire\WithPagination;

class Authors extends Component
{
    use WithPagination;

    public $query;

    public function render()
    {
        if (mb_strlen(escapeElasticReservedChars($this->query)) < 3) {
            $authors = Author::with(['image'])->when($this->query, function ($query) {
                $query->where('name', 'like', '%' . $this->query . '%');
            })->paginate(10);
        } else {
            $authors = Author::search(escapeElasticReservedChars($this->query))->paginate(10);

        }
        return view('livewire.authors', compact('authors'));
    }

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function paginationView(): string
    {
        return 'vendor.livewire.bootstrap';
    }
}
