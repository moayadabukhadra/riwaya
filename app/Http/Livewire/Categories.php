<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\CategoryTranslation;
use Livewire\Component;

class Categories extends Component
{

    public $en_name;
    public $en_description;
    public $ar_name;
    public $ar_description;
    public $language = 'ar';
    public $searchTerm;
    protected $listeners = [
        'language' => 'language',
    ];

    public function render()
    {
        $search = "%" . $this->searchTerm . "%";
        $categories = CategoryTranslation::where('locale', '=', $this->language)->where('name', 'like', $search)->get();
        return view('livewire.categories', [
            'categories' => $categories
        ]);
    }

    public function store()
    {

        $category = Category::create([

            'en' => [
                'name' => $this->en_name,
                'description' => $this->en_description
            ],
            'ar' => [
                'name' => $this->ar_name,
                'description' => $this->ar_description
            ]
        ]);
    }


    public function language($language)
    {
        $this->language = $language;
    }

    public function delete(Category $category){
         $category->delete();
    }


}
