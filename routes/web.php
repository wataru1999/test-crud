<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



route::get('/students', [StudentController::class, 'index'])->name('students');

route::put('/students', [StudentController::class, 'update'])->name('students.update');

// Hehe Route
route::resource('students', StudentController::class)->except(['update', 'index']);

require __DIR__.'/auth.php';