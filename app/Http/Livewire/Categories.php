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

        $categories = Category::with('image')
            ->when($this->query, function ($query) {
                $query->where('name', 'like', '%' . $this->query . '%');
            })
            ->paginate(10);

        return view('livewire.categories', compact('categories'));
    }

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function deleteCategory(Category $category){
        $category->delete();
    }
    public function paginationView(): string
    {
        return 'vendor.livewire.bootstrap';
    }


}
