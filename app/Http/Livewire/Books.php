<?php

namespace App\Http\Livewire;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Books extends Component
{
    use WithPagination;

    public $authors;
    public $categories;
    public $selected_author;
    public $selected_category;
    public $query;

    public function mount()
    {
        $this->authors = Author::all();
        $this->categories = Category::all();
    }

    public function render()
    {
        if(mb_strlen($this->query) < 3) {
            $books = Book::with(['image','author','category'])  ->when($this->selected_author, function ($query) {
                return $query->where('author_id', $this->selected_author);
            })
                ->when($this->selected_category, function ($query) {
                    return $query->where('category_id', $this->selected_category);
                })
                ->paginate(10);
        }else{
            $books = Book::search($this->query)
                ->when($this->selected_author, function ($query) {
                    return $query->where('author_id', $this->selected_author);
                })
                ->when($this->selected_category, function ($query) {
                    return $query->where('category_id', $this->selected_category);
                })
                ->paginate(10);
        }

        return view('livewire.books',compact('books'));
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
