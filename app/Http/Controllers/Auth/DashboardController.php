<?php

namespace App\Http\Controllers\Auth;
use App\Models\Ticket;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function refreshTable()
    {
        $ticket = Ticket::where('status', 'Open')->get();
        $html = view('partials.table', compact('ticket'))->render();
    
        return response()->json(['html' => $html]);
    }
    

    public function refreshTableSolved()
    {
        $ticket = Ticket::where('status', 'Solved')->get();
        $html = view('partials.table_solved', compact('ticket'))->render();
    
        return response()->json(['html' => $html]);
    }

    public function refreshTablePending()
    {
        $ticket = Ticket::where('status', 'Pending')->get();
        $html = view('partials.table_pending', compact('ticket'))->render();
    
        return response()->json(['html' => $html]);
    }
    
    public function refreshTableProgress()
    {
        $ticket = Ticket::where('status', 'Progress')->get();
        $html = view('partials.table_progress', compact('ticket'))->render();
    
        return response()->json(['html' => $html]);
    }
    public function refreshAssignedTable(Ticket $ticket)
    {
        $users = User::where('role', 'tech_person')->get();
        $html = view('partials.table_user_tech', compact('users', 'ticket'))->render();

        return response()->json(['html' => $html]);
    }
    
    // Similar methods for progress, pending, and solved tables

    public function refreshTicketCounts()
{
    $ticket = Ticket::all();

    $openTickets = $ticket->where('status', 'Open')->count();
    $pendingTickets = $ticket->where('status', 'Pending')->count();
    $progressTickets = $ticket->where('status', 'Progress')->count();
    $solvedTickets = $ticket->where('status', 'Solved')->count();

    return response()->json(compact('openTickets', 'pendingTickets', 'progressTickets', 'solvedTickets'));
}

    public function index()
    {
        $orderBy = 'created_at'; // default order by created_at
        $orderDirection = 'desc'; // default order direction
    
        $ticket = Ticket::orderBy($orderBy, $orderDirection)->get();
        $user = User::all();
    
        $openTickets = $ticket->where('status', 'Open')->count();
        $pendingTickets = $ticket->where('status', 'Pending')->count();
        $progressTickets = $ticket->where('status', 'Progress')->count();
        $solvedTickets = $ticket->where('status', 'Solved')->count();
    
        return view('auth.dashboard', [
            "ticket" => $ticket,
            "Users" => $user,
            "openTickets" => $openTickets,
            "pendingTickets" => $pendingTickets,
            "progressTickets" => $progressTickets,
            "solvedTickets" => $solvedTickets,
            "ticketCounts" => compact('openTickets', 'pendingTickets', 'progressTickets', 'solvedTickets'),
            "orderBy" => $orderBy,
            "orderDirection" => $orderDirection,
        ]);
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
