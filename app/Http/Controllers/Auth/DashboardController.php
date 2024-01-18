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
    
    // Similar methods for progress, pending, and solved tables

    public function index()
    {
        $ticket = Ticket::all();
        $user = User::all();

        $openTickets = $ticket->where('status', 'Open')->count();
        $pendingTickets = $ticket->where('status', 'Pending')->count();
        $progressTickets = $ticket->where('status', 'Progress')->count();
        $solvedTickets = $ticket->where('status', 'Solved')->count();
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
