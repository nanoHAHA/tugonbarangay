<?php

use App\Livewire\AdminDashboard;
use App\Livewire\BlotterArchive;
use App\Livewire\ReportIncident;
use App\Livewire\StaffLogin;
use App\Livewire\SystemEvaluation;
use App\Livewire\TrackIncident;
use App\Livewire\WelcomeHome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', WelcomeHome::class)->name('home');
Route::get('/report', ReportIncident::class)->name('report');
Route::get('/track', TrackIncident::class)->name('track');
Route::get('/evaluate', SystemEvaluation::class)->name('evaluate');

 // Standard view routing na diretsong tumatawag sa Blade file
Route::get('/about', App\Livewire\AboutPage::class)->name('about');
Route::get('/contact', App\Livewire\Contactpage::class)->name('contact');
 
// Authentication Route
Route::get('/login', StaffLogin::class)->name('login')->middleware(['guest', 'throttle:10,1']);
Route::get('/admin/messages', App\Livewire\AdminMessages::class)->name('admin.messages');

// Logout Route
Route::match(['get', 'post'], '/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Protected Admin / Staff Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/archives', BlotterArchive::class)->name('admin.archives');
});