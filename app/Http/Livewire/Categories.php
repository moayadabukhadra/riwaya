<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public $query;

    public function render()
    {
        if(mb_strlen(escapeElasticReservedChars($this->query)) < 3){
            $categories = Category::with('image')->paginate(10);
        }else{
            $categories = Category::search(escapeElasticReservedChars($this->query))->paginate(10);
        }
        return view('livewire.categories',compact('categories'));
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
