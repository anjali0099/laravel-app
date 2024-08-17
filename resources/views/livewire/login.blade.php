<div class="card">
    <h5 class="card-header">Login</h5>
    <div class="card-body">
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="loginUser">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" wire:model="email" class="form-control" required
                    aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" wire:model="password" class="form-control"
                    required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div class="mt-3">
            Don't have an account? <a href="/register" class="btn btn-success">Register</a>
        </div>
    </div>
</div>
