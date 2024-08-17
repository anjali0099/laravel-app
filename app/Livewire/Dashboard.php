<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $users;
    public $showCreateForm = false;
    public $first_name, $last_name, $email;

    public function mount()
    {
        // Fetch all users except the currently authenticated user
        $this->users = User::where('id', '!=', Auth::id())->get();
    }

    public function edit($userId)
    {
        return redirect()->route('users.edit', $userId);
    }

    public function delete($userId)
    {
        User::find($userId)->delete();
        $this->users = User::where('id', '!=', Auth::id())->get();
        session()->flash('message', 'User deleted successfully.');
    }

    public function sendEmail($userId)
    {
        $user = User::find($userId);

        if ($user) {
            //Email verification notification
            $user->sendEmailVerificationNotification();

            session()->flash('message', 'Verification email sent successfully.');
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
