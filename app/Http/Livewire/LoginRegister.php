<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LoginRegister extends Component
{
    public $users, $email, $password, $name;
    public $registerForm = true;

    public function render()

    {

        return view('livewire.login-register');


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
                session()->flash('message', "You are Login successful.");
        }else{
            session()->flash('error', 'email and password are wrong.');
            $this->emit('alert_remove');
        }
    }






}

public function register()
{
    $this->registerForm = !$this->registerForm ;
}

public function store()
{
    $this->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
    ]);

    $this->password = Hash::make($this->password);

   $user =  User::create(['name' => $this->name, 'email' => $this->email,'password' => $this->password]);

    Auth::login($user);



    session()->flash('message', 'Your register successfully Go to the login page.');
    $this->emit('alert_remove');

    return redirect('/dashboard');

}


}
