<?php

use Illuminate\Support\Facades\Route;

// Guest Routes
Route::get('/login', function () {
    if (request()->expectsJson()) {
        return response()->json([
            'message' => 'Sesi Anda telah berakhir. Silakan login kembali.',
            'error' => 'Unauthenticated'
        ], 401);
    }
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/verify-otp', function () {
    return view('auth.verify-otp');
})->name('verify-otp');

// Authenticated Views (client-side guarded via localStorage token)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/analytics', function () {
    return view('analytics');
})->name('analytics');

Route::get('/analytics/system', function () {
    return view('analytics-system');
})->name('analytics.system');

Route::get('/analytics/security', function () {
    return view('analytics-security');
})->name('analytics.security');

Route::get('/report', function () {
    return view('report');
})->name('report');

Route::get('/help', function () {
    return view('help');
})->name('help');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

// Root Route Redirect
Route::get('/', function () {
    return redirect()->route('dashboard');
});
