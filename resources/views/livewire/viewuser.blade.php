<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h3>User Details</h3>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">
            Back to Dashboard
        </a>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <h4 class="mb-0">
                {{ ucfirst(strtolower($user->first_name)) . ' ' . ucfirst(strtolower($user->last_name)) }}
            </h4>
        </div>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Created At:</strong> {{ $user->created_at }}</p>
    </div>
</div>
