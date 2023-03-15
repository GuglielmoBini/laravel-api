<?php

use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GuestHomeController::class, 'index']);


// rotte protette
Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {
    // home
    Route::get('/', [AdminHomeController::class, 'index'])->name('home');
    // rotte dei progetti
    Route::resource('projects', ProjectController::class);
    // rotte dei tipi
    Route::resource('types', TypeController::class);
    // rotte delle tecnologie
    Route::resource('technologies', TechnologyController::class);
});


Route::middleware('auth')->name('profile.')->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__ . '/auth.php';

// Route::resource('admin/technologies', App\Http\Controllers\Admin\TechnologyController::class, ['as' => 'admin']);
