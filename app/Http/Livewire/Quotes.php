<?php

namespace App\Http\Livewire;

use App\Models\Author;
use App\Models\Quote;
use Livewire\Component;
use Livewire\WithPagination;

class Quotes extends Component
{
    use WithPagination;
    public $query;
    public $authors;
    public $selected_author;

    public function mount(){
        $this->authors = Author::all();
    }

    public function render()
    {
        $quotes = Quote::with('author')
            ->when($this->selected_author, function ($query) {
                 $query->where('author_id', $this->selected_author);
            })->when($this->query, function ($query) {
                $query->where('body', 'like', '%' . $this->query . '%');
            })->paginate(10);
        return view('livewire.quotes', compact('quotes'));
    }

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function deleteQuote(Quote $quote){
        $quote->delete();
    }

    public function  paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
}
