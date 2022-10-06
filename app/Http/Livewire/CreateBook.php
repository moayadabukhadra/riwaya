<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Livewire\Component;

class CreateBook extends Component
{
    public $language='ar';

    protected $listeners = [
        'language' => 'language',
    ];


    public function render()
    {


        return view('livewire.create-book',[
            'categories'=>CategoryTranslation::where('locale' , '=' , $this->language)->get()
        ]);
    }

    public function language($language)
    {
        $this->language = $language;
    }



}
