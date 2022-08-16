<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Category;
use Livewire\Component;

class DropDown extends Component
{
    public $dropDown = null;
    public $categories;
    public $selectedCategory;


    public function mount(){
        $this->categories = Category::all();
    }

    public function selectDropDown($DropDown){
        $this->DropDown = $DropDown;
    }




    public function render()
    {
        return view('livewire.drop-down');
    }

    public function SelectCategory($category)
    {
        $this->selectedCategory = $category;
        $this->emit('selectCategory', $category);
    }

}
