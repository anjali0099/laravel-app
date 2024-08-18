<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Component
{
    public $userId;
    public $first_name, $last_name, $email, $password;
    public $isEdit = false;

    /**
     * Initialize component state.
     *
     * @param  int|null  $userId  The ID of the user to edit, if any.
     * @return void
     */
    public function mount($userId = null)
    {
        if ($userId) {
            $this->userId = $userId;
            $this->isEdit = true;
            $user = User::find($userId);
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
        }
    }

    /**
     * Save or update the user based on the form data.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveUser()
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ];

        // Add password validation only if creating a new user
        if (!$this->isEdit) {
            $rules['password'] = 'required|min:8|max:30';
        }
        $this->validate($rules);

        if ($this->isEdit) {
            $user = User::find($this->userId);
            $user->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'password' => $this->password ? Hash::make($this->password) : $user->password,
            ]);
        } else {
            User::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);
        }

        session()->flash('message', $this->isEdit ? 'User updated successfully.' : 'User created successfully.');
        return redirect()->route('dashboard');
    }

    /**
     * Render the component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.createuser');
    }
}
