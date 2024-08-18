<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    /**
     * Render the navbar component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.navbar');
    }

    /**
     * Log out the current user and redirect to the login page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $this->redirect('/login', navigate: true);
    }
}
