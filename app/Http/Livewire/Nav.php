<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Nav extends Component
{
    public $searchTerm;
    public function render()
    {
        return view('livewire.nav');
    }

    public function search()
    {

        $this->emit('search', $this->searchTerm);
    }

    public function logout()
    {
        Auth::logout();
        $this->emit('logout');
    }
}
