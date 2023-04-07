<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $query;

    public function render()
    {
        $users = User::when($this->query, function ($query) {
            $query->where('name', 'like', '%' . $this->query . '%')
                ->orWhere('email', 'like', '%' . $this->query . '%');
        })->paginate(10);
        return view('livewire.users', compact('users'));
    }

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function deleteUser(User $user)
    {
        $user->delete();
    }

    public function paginationView(): string
    {
        return 'vendor.livewire.bootstrap';
    }
}
