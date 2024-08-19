<div class="card">
    <div class="card-body">
        <!-- Create User Button -->
        <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Create User</a>

        @if (session()->has('message'))
            <div class="alert alert-success mt-3">
                {{ session('message') }}
            </div>
        @endif
        <!-- Users Table -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button wire:click="edit({{ $user->id }})" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Delete Button -->
                            <button type="button" wire:click="delete({{ $user->id }})"
                                class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            <!-- Send Verification Email Button -->
                            <button
                                wire:click="sendEmail({{ $user->id }})"
                                class="btn btn-warning btn-sm"
                                @if ($user->hasVerifiedEmail()) disabled @endif>
                                <i class="fas fa-envelope"></i>
                                Send Verification Email
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
