<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    /**
     * Render the login component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.login');
    }

    /**
     * Validate credentials and attempt to log the user in.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginUser()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the email exists in the database
        $user = User::where('email', $this->email)->first();

        if (!$user) {
            session()->flash('error', 'No account found with this email address.');
            return redirect()->back()->withInput(['email' => $this->email]);
        }

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();
            return redirect()->to('/dashboard');
        }

        // Incorrect password
        session()->flash('error', 'The provided password is incorrect.');
        return redirect()->back()->withInput(['email' => $this->email]);
    }
}
