<div class="card">
    <h5 class="card-header">Register</h5>
    <div class="card-body">
        @if (session()->has('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form class="row g-3" wire:submit.prevent="store">
            <div class="col-md-6">
                <label for="first_name" class="form-label">First Name</label>
                <input wire:model="first_name" type="text" class="form-control" placeholder="First name"
                    name="first_name" id="first_name">
                <div>
                    @error('first_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <label for="last_name" class="form-label">Last Name</label>
                <input wire:model="last_name" type="text" class="form-control" placeholder="Last name"
                    name="last_name" id="last_name">
                <div>
                    @error('last_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input wire:model="email" type="email" class="form-control" id="email" name="email"
                    placeholder="Enter Email Address">
                <div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input wire:model="password" type="password" class="form-control" id="password" name="password"
                    placeholder="Enter Password">
                <div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </form>
        <div class="mb-3">
            Already have an account? <button wire:navigate href="/login" class="btn btn-success">Login</button>
        </div>
    </div>
</div>
