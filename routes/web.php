<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\SeatController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function (Request $request) {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::patch('/dashboard', function (Request $request) {
    $user = $request->user();
    $seat = $user->seat;
    $seat->user_id = NULL;
    $seat->update();
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('leave');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/select', [LabController::class, 'index'])->name('select');
    Route::post('/select', [LabController::class, 'show'])->name('select.lab');
    Route::patch('/select', [SeatController::class, 'update'])->name('select.seat');
});

Route::middleware('auth')->group(function () {
    Route::get('/request', function () {
        return view('request.upload');
    })->name('request.upload');
});

Route::middleware('auth')->group(function () {
    Route::get('/review', function (Request $request) {
        return view('review.show', ['submission' => \App\Models\Submission::find(1)]);
    })->name('review');
});

require __DIR__.'/auth.php';
