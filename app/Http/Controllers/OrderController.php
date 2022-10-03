<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function store(Request $request)
    {
       $order= $request->validate([
            'city' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'name' => 'required',
            'coustomer_note' => 'nullable',
        ]);

        $order['user_id'] = auth()->user()->id;
        $order['status'] = 'pending';
        $order['total'] = \Cart::getTotal();
        $order['items'] = \Cart::getContent()->toJson();


        Order::create($order);
        \Cart::clear();
        session()->flash('message', 'Order created successfully.');
        return redirect('/shopping-cart');

    }

    public function edit(Request $request, Order $order){

        $request->validate([
            'notes'=>'required',
            'address'=>'required',
            'phone'=>'required|max:20'
        ]);

        dd($request);


    }


}
