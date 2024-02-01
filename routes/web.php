<?php

use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DashboarTechController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\TaskController; // Import your TaskController
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatController;


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
    return view('auth.login');
});

Auth::routes();

// Route::get('auth/dashboard', [DashboardController::class, 'dashboard'])->name('auth.dashboard')->middleware('auth');
Route::resource('auth/posts', PostController::class);

//Tech Person
Route::group(['middleware' => 'tech_person'], function () {
    // Routes for tech persons
    Route::resource('dashboard-tech', DashboarTechController::class);
    Route::get('/dashboard-tech/detail_ticket/{id}/edit', [DashboarTechController::class, 'edit'])->name('detail_ticket.edit');
    Route::put('/update-ticket-status/{ticket}', [DashboarTechController::class, 'updateStatus'])->name('update.ticket.status');
});

Route::get('/refresh-table', [DashboardController::class, 'refreshTable'])->name('refresh.table');
Route::get('/refresh-table-progress', [DashboardController::class, 'refreshTableProgress'])->name('refresh.table_progress');
Route::get('/refresh-table-pending', [DashboardController::class, 'refreshTablePending'])->name('refresh.table_pending');
Route::get('/refresh-table-solved', [DashboardController::class, 'refreshTableSolved'])->name('refresh.table_solved');
Route::get('/refresh-table-tech-person', [DashboarTechController::class, 'refreshTableTechPerson'])
    ->name('refresh.table_tech_person');
Route::get('/refresh-ticket-counts', [DashboardController::class, 'refreshTicketCounts'])->name('refresh.ticket_counts');
Route::get('/refresh-table-user-tech', 'DashboardController@refreshTableUserTech')->name('refresh.table_user_tech');



//Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('auth/dashboard', [DashboardController::class, 'index'])->name('auth.dashboard');
    Route::resource('detail_ticket-admin', DashboardController::class);
    Route::get('admin_ticket_detail/{id}/edit', [DashboardController::class, 'edit'])->name('admin_ticket_detail.edit');
    Route::put('/assign-ticket/{ticket}', [TicketController::class, 'assign'])->name('assign.ticket');
    Route::get('/refresh-assigned-table/{ticket}', [DashboardController::class, 'refreshAssignedTable'])->name('refresh.assigned.table');
});




//User
Route::resource('dashboard-user', DashboardUserController::class);
Route::group(['middleware' => 'user'], function () {
    // Your routes for users go here
    Route::get('/my_ticket', [DashboardUserController::class, 'myTickets'])->name('my_ticket');
    Route::get('/my_ticket/detail_ticket_user/{id}/edit', [DashboardUserController::class, 'edit'])->name('detail_ticket_user.edit');
});


Route::resource('dashboard-user', DashboardUserController::class);
Route::get('/detail_ticket_user', [DashboardUserController::class, 'show'])->name('detail_ticket_user');
//Route::get('/my_ticket', [DashboardUserController::class, 'create'])->name('my_ticket');

//Route::get('/new_ticket', [DashboardUserController::class, 'show'])->name('new_ticket');

//Admin

Route::get('auth/dashboard', [DashboardController::class, 'index'])->name('auth.dashboard')->middleware('auth');
Route::resource('detail_ticket-admin', DashboardController::class);
Route::get('admin_ticket_detail/{id}/edit', [DashboardController::class, 'edit'])->name('admin_ticket_detail.edit');
Route::put('/assign-ticket/{ticket}', [TicketController::class, 'assign'])->name('assign.ticket');


// Route::prefix('chat')->group(function () {
//     Route::get('/{ticketId}', 'ChatController@getMessages');
//     Route::post('/{ticketId}', 'ChatController@sendMessage');
// });

// // Route to load chat messages
// Route::get('/chat/{ticketId}', 'ChatController@index')->name('chat.index');

// // Route to send chat messages
// Route::post('/chat/{ticketId}', 'ChatController@store')->name('chat.store');



Route::prefix('chat')->group(function () {
    Route::get('/{ticketId}', [ChatController::class, 'getMessages']);
    Route::post('/{ticketId}', [ChatController::class, 'sendMessage']);
});

// Route to load chat messages
Route::get('/chat/{ticketId}', [ChatController::class, 'index'])->name('chat.index');

// Route to send chat messages
Route::post('/chat/{ticketId}', [ChatController::class, 'store'])->name('chat.store');


Route::put('/tickets/{ticket}/assign/{user}', 'TicketController@assign')->name('tickets.assign');
Route::get('/tickets/{id}/details', 'TicketController@getDetails');
// Route::get('/auth/dashboard/{id}', 'DashboardController@showTicketDetails');
Route::get('/auth/get-ticket-details/{id}', 'TicketController@getTicketDetails');

// Route::get('/chat/{ticketId}', function ($ticketId) {
//     // Test route to see if it's reachable
//     return "Test Route for ChatController@index";
// });

// Route::post('/chat/{ticketId}', function ($ticketId) {
//     // Test route to see if it's reachable
//     return "Test Route for ChatController@store";
// });