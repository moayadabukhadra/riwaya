<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Category;
use Livewire\Component;

class ShowBook extends Component
{

    public $item;
    public $show = false;
    public $selectedBook;


    use \Livewire\WithPagination;
    public $searchTerm;



    protected $listeners = [
        'search' => 'search'
    ];

    public function search($searchTerm)
    {
        $this->searchTerm = $searchTerm;
    }

    public function allBooks()
    {
        $this->show = false;
    }





    public function mount()
    {
    }
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        return view('livewire.show-book', [
            'books' => Book::where('title', 'like', $searchTerm)->orWhere('author', 'like', $searchTerm)->paginate(12),
        ]);
    }

    public function show($id)
    {
        $this->show = true;
        $this->selectedBook = Book::find($id);
    }


    public function addToCart($item)
    {
        \Cart::add([
            'id' => $item['id'],
            'name' => $item['title'],
            'price' => $item['price'],
            'quantity' => 1,
            'attributes' => array(
                'image' => $item['image'],
            )
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');
        $this->emit('alert_remove');
    }
}
