<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CheckOut extends Component
{
    public $cartItems = [];

    public function render()
    {
        $this->cartItems = \Cart::getContent()->toArray();

        return view('livewire.check-out');
    }
}
