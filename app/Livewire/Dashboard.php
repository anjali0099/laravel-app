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
    public $first_name, $last_name, $email;

    /**
     * Initialize component state.
     *
     * @return void
     */
    public function mount()
    {
        // Fetch all users except the currently authenticated user
        $this->users = User::where('id', '!=', Auth::id())->get();
    }

    /**
     * Redirect to the edit page for the specified user.
     *
     * @param  int  $userId  The ID of the user to edit.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($userId)
    {
        return redirect()->route('users.edit', $userId);
    }

    /**
     * Delete the specified user and refresh the user list.
     *
     * @param  int  $userId  The ID of the user to delete.
     * @return void
     */
    public function delete($userId)
    {
        User::find($userId)->delete();
        $this->users = User::where('id', '!=', Auth::id())->get();
        session()->flash('message', 'User deleted successfully.');
    }

    /**
     * Send a verification email to the specified user.
     *
     * @param  int  $userId  The ID of the user to send the email to.
     * @return void
     */
    public function sendEmail($userId)
    {
        $user = User::find($userId);

        if ($user) {
            // Email verification notification
            $user->sendEmailVerificationNotification();

            session()->flash('message', 'Verification email sent successfully.');
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    /**
     * Render the component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.dashboard');
    }
}
