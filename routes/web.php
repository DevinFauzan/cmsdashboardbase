<?php

use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboarTechController;
use App\Http\Controllers\TaskController; // Import your TaskController
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
    auth()->logout();
    return 'landing page';
});

Auth::routes();

Route::get('auth/dashboard', [DashboardController::class, 'dashboard'])->name('auth.dashboard')->middleware('auth');
Route::resource('auth/posts', PostController::class);


Route::resource('dashboard-tech', DashboarTechController::class);
Route::get('/detail_ticket', [DashboarTechController::class, 'show'])->name('detail_ticket');

// Route::resource('dashboard-tech', DashboarTechController::class);

