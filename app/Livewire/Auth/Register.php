<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.register');
    }

    public function store()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:30',
        ]);

        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);
        event(new Registered($user));

        Auth::login($user);

        session()->flash('success', 'Registration successful');
        return redirect()->to('/login');
    }
}
