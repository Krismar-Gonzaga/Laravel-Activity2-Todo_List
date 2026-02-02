<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');;
Route::put('/tasks/{task}/toggle-status', [TaskController::class, 'toggleStatus'])->name('tasks.toggle-status');



Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');
    
    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    
    Route::put('/profile/image', [ProfileController::class, 'updateImage'])
        ->name('profile.image.update');

    Route::delete('/profile/image', [ProfileController::class, 'deleteImage'])
        ->name('profile.image.delete');

    // Settings (email & password)
    Route::get('/settings', [ProfileController::class, 'settings'])
        ->name('settings.show');

    Route::put('/settings/email', [ProfileController::class, 'updateEmail'])
        ->name('settings.update-email');

    Route::put('/settings/password', [ProfileController::class, 'updatePassword'])
        ->name('settings.update-password');
});

Route::middleware(['auth.check'])->group(function () {
    Route::resource('tasks', TaskController::class);
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Tasks CRUD
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::post('/', [TaskController::class, 'store'])->name('store');
        Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('edit');
        Route::put('/{task}', [TaskController::class, 'update'])->name('update');
        Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');
        Route::get('/search', [TaskController::class, 'search'])->name('tasks.search');
    });
});

// // Redirect root to dashboard if authenticated
// Route::get('/dashboard', function () {
//     return auth()->check() ? redirect('/dashboard') : view('dashboard');
// });