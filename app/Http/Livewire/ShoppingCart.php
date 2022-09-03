<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Darryldecode\Cart\Cart;
use Livewire\Component;

class ShoppingCart extends Component
{


    protected $listeners = [
        'cartUpdated' => '$refresh',
        'removeCart' => 'remove'
    ];

    public $cartItems = [];

    public function remove()
    {
        session()->flash('success', 'Item has removed !');
        $this->emit('alert_remove');

    }


    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');
    }

    public function render()
    {
        $this->cartItems = \Cart::getContent()->toArray();

        return view('livewire.shopping-cart');
    }


}
