<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ViewUser extends Component
{
    /**
     * The User model instance.
     *
     * @var User
     */
    public User $user;

    /**
     * Initialize the component with the given User model.
     *
     * @param User $user
     * @return void
     */
    public function mount(User $user)
    {
        $this->user = $user;
    }

    /**
     * Render the component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.viewuser');
    }
}
