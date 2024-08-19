<div class="card">
    <div class="d-flex justify-content-between align-items-center p-3">
        <h2 class="card-header mb-0">
            {{ $isEdit ? 'Edit User' : 'Create User' }}
        </h2>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">
            Back to Dashboard
        </a>
    </div>
    <div class="card-body">
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <form class="row g-3" wire:submit.prevent="saveUser">
            <div class="col-md-6">
                <label for="first_name" class="form-label">First Name</label>
                <input wire:model="first_name" type="text" class="form-control" id="first_name" name="first_name"
                    placeholder="First name">
                @error('first_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="last_name" class="form-label">Last Name</label>
                <input wire:model="last_name" type="text" class="form-control" id="last_name" name="last_name"
                    placeholder="Last name">
                @error('last_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input wire:model="email" type="email" class="form-control" id="email" name="email"
                    placeholder="Enter Email Address">
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input wire:model="password" type="password" class="form-control" id="password" name="password"
                    placeholder="Enter Password">
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-success">{{ !$isEdit ? 'Add User' : 'Update User' }}</button>
            </div>
        </form>
    </div>
</div>