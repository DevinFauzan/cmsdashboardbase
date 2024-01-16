<?php

namespace App\Http\Controllers\Auth;
use App\Models\Ticket;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ticket = Ticket::all();
        $user = User::all();

        return view('auth.dashboard',["ticket"=> $ticket, "Users" => $user]);
    }

    public function edit($id)
{
    $ticket = Ticket::find($id);

    if (!$ticket) {
        abort(404, "Record not found");
    }

    $users = User::all();
    return view('pages.admin.admin_ticket_detail', compact('ticket', 'users'));
}

}
