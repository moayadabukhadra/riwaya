<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Category;
use Livewire\Component;

class CreateBook extends Component
{
    public $categories;



    public function render()
    {
        return view('livewire.create-book');
    }





}
