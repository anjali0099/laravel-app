<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">Laravel App</a>
        <ul class="navbar-nav me-auto">
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard" wire:navigate>Dashboard</a>
                </li>
            @endauth
        </ul>

        <!-- Toggler button for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login" wire:navigate>Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register" wire:navigate>Register</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item d-flex align-items-center">
                        <span class="navbar-text me-3 mb-0">Welcome,
                            {{ Auth::user()->first_name }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" wire:click.prevent="logout">Logout</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
