<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{
    public $show = false;
    public $selectedOrder;
    public $selectedOrderItems=[];
    public $address;
    public $customer_note;
    public $phone;

    use \Livewire\WithPagination;
    public $searchTerm;




    public function show($id){

        $this->selectedOrder = Order::find($id);
        $this->selectedOrderItems = json_decode($this->selectedOrder->items,true);
        $this->show = true;
    }
    public function render()
    {

        return view('livewire.orders',[
            'orders' => Order::where('name', 'like', '%'.$this->searchTerm.'%')->orWhere('status', 'like', '%'.$this->searchTerm.'%')->orderBy('created_at','desc')->paginate(2),
        ]);
    }

    public function updateToDone($id){
        $order = Order::find($id);
        $order->status = 'delivered';
        $order->save();
        $this->show = false;
        session()->flash('message', 'Order updated successfully.');

    }

    public function updateToInProgress($id){
        $order = Order::find($id);
        $order->status = 'in progress';
        $order->save();
        $this->show = false;
        session()->flash('message', 'Order updated successfully.');

    }

    public function edit(){

        $this->selectedOrder->update([
            'phone'=>$this->phone,
            'customer_note'=>$this->customer_note,
            'address'=>$this->address
        ]);

    }
}
