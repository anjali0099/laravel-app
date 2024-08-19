<?php

use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\CreateUser;
use App\Livewire\Home;
use App\Livewire\ViewUser;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', Home::class);

// Route to show email verification notice page
Route::get('/email/verify', function () {
    if (auth()->check() && auth()->user()->hasVerifiedEmail()) {
        return redirect()->route('dashboard');
    }

    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Route to handle email verification link
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $user = $request->user();

    if ($user->hasVerifiedEmail()) {
        return redirect()->route('dashboard')->with('message', 'You are already verified.');
    }

    // Mark email as verified and redirect to dashboard
    if ($user->markEmailAsVerified()) {
        return redirect()->route('dashboard')->with('message', 'Your email has been verified.');
    }

    return redirect()->route('verification.notice')->withErrors('Verification failed.');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Route to send a new email verification notification
Route::post('/email/verification-notification', function (Request $request) {
    $user = $request->user();

    if ($user->hasVerifiedEmail()) {
        return redirect()->route('dashboard')->with('message', 'You are already verified.');
    }

    $user->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');

// Route for user dashboard, accessible only to authenticated and verified users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/users/create', CreateUser::class)->name('users.create');
    Route::get('/users/edit/{user}', CreateUser::class)->name('users.edit');
    Route::get('/users/{user}', ViewUser::class)->name('users.view');
});
