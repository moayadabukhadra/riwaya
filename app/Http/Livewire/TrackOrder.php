<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TrackOrder extends Component
{
    public $orders;
    public $order;
    public $show=false;
    public $selectedOrderItems=[];

    public function render()
    {
        return view('livewire.track-order');
    }

    public function mount(){
        $this->orders = auth()->user()->orders;
    }

    public function showOrder($id){
        $this->order = auth()->user()->orders->find($id);
        $this->selectedOrderItems = json_decode($this->order->items,true);
        $this->show = true;

    }

    public function all()
    {
        $this->show = false;
    }


}
