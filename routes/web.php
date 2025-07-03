<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Frontend Routes (Public Access)
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/books', [FrontendController::class, 'books'])->name('frontend.books');
Route::get('/books/{id}', [FrontendController::class, 'bookDetail'])->name('frontend.book.detail');
Route::get('/search', [FrontendController::class, 'search'])->name('frontend.search');

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    $credentials = request()->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        request()->session()->regenerate();

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('home');
        }
    }
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
})->name('login.post');

Route::delete('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Admin Routes (Protected)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Books Management
    Route::resource('books', BookController::class);

    // Categories Management
    Route::resource('categories', CategoryController::class);

    // Publishers Management
    Route::resource('publishers', PublisherController::class);

    // Members Management
    Route::resource('members', MemberController::class);

    // Borrowings Management
    Route::resource('borrowings', BorrowingController::class);
});

// User Routes (Protected)
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');

    Route::get('/borrowings', function () {
        return view('user.borrowings');
    })->name('borrowings');
});
