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

    /**
     * Render the registration component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.register');
    }

    /**
     * Validate and store the new user, then log them in.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:30',
        ]);

        // Create a new user
        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        // Fire the Registered event
        event(new Registered($user));

        // Log in the newly registered user
        Auth::login($user);

        // Set a success message and redirect to login
        session()->flash('success', 'Registration successful');
        return redirect()->to('/login');
    }
}
