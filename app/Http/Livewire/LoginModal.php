<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginModal extends Component
{
    public $email, $password;


    public function render()
    {
        return view('livewire.login-modal');
    }

    public function login(){
        {
            $validatedDate = $this->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if(Auth::attempt(array('email' => $this->email, 'password' => $this->password))){

                    Auth::login(User::where('email', $this->email)->first());

                    return redirect('/dashboard');
            }else{

                session()->flash('error', 'email and password are wrong.');
                $this->emit('alert_remove');
            }

        }


}
}
