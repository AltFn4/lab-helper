<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\InquiryController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/labs', [LabController::class, 'index'])->name('labs.index');
    Route::post('/labs', [LabController::class, 'show'])->name('select.lab');
    Route::patch('/labs', [SeatController::class, 'update'])->name('select.seat');
    Route::delete('/labs', [SeatController::class, 'destroy'])->name('labs.leave');
});

Route::get('/request', function (Request $request) {
    return view('request.edit');
})->middleware(['auth', 'verified'])->name('request.edit');

Route::middleware('auth')->group(function () {
    Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiry.index');
    Route::get('/inquiry', [InquiryController::class, 'edit'])->name('inquiry.edit');
    Route::post('/inquiry', [InquiryController::class, 'create'])->name('inquiry.create');
});

require __DIR__.'/auth.php';
