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

        $openTickets = $ticket->where('status', 'open')->count();
        $pendingTickets = $ticket->where('status', 'pending')->count();
        $progressTickets = $ticket->where('status', 'progress')->count();
        $solvedTickets = $ticket->where('status', 'solved')->count();
        return view('auth.dashboard',["ticket"=> $ticket, "Users" => $user,
         "openTickets" => $openTickets,"pendingTickets" => $pendingTickets,
         "progressTickets" => $progressTickets,"solvedTickets" => $solvedTickets]);
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
