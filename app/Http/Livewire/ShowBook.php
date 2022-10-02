<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\BookTranslation;
use App\Models\Category;
use Livewire\Component;

class ShowBook extends Component
{

    public $item;
    public $show = false;
    public $selectedBook;
    public $language="ar";
    public $searchTerm;

    use \Livewire\WithPagination;




    public function mount() {
        $this->language= "ar";
    }

    protected $listeners = [
        'search' => 'search',
        'language' => 'language',
    ];


    public function allBooks()
    {
        $this->show = false;
    }




    public function render()
    {
        $search='%'.$this->searchTerm.'%';

        $books = BookTranslation::where('locale' , 'like' ,$this->language)
            ->where('title' , 'like' ,$search)->get();

        return view('livewire.show-book', [
        'books' => $books,
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

    public function language($language)
    {
        $this->language = $language;
    }
}
