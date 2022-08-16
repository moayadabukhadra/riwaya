<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartItem extends Component
{
    public $item;


    public function mount($item)
    {
        $this->cartItems = $item;

        $this->quantity = $item['quantity'];
    }


    public function removeCart($id)
    {
        \Cart::remove($id);

        session()->flash('success', 'Item has removed !');
        $this->emit('removeCart');
        $this->emit('alert_remove');
    }

    public function updateCart()
    {
        \Cart::update($this->cartItems['id'], [
            'quantity' => [
                'relative' => false,
                'value' => $this->quantity
            ]
        ]);

        $this->emit('cartUpdated');
    }

    public function render()
    {
        return view('livewire.cart-item');
    }

}
