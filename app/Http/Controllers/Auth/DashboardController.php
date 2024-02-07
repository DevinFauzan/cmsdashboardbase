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
        $user = User::where('is_premium', 1)->whereIn('id', $ticket->pluck('user_id'))->get();
        $user = $user->sortByDesc('is_premium');

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

    public function refreshTableOnHold()
    {
        $ticket = Ticket::where('status', 'onhold')->get();
        $html = view('partials.table_onhold', compact('ticket'))->render();

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
        $onholdTickets = $ticket->where('status', 'onhold')->count();
        $allTickets = $ticket->count();

        return response()->json(compact('openTickets', 'pendingTickets', 'progressTickets', 'solvedTickets', 'onholdTickets', 'allTickets'));
    }

    public function index()
    {
        $orderBy = 'user'; // default order by created_at
        $orderDirection = 'desc'; // default order direction

        $ticket = Ticket::where('status', 'Open')->get();
        $user = User::where('is_premium', 1)->whereIn('id', $ticket->pluck('user_id'))->get();

        $user = $user->sortByDesc('is_premium');

        $openTickets = $ticket->where('status', 'Open')->count();
        $pendingTickets = $ticket->where('status', 'Pending')->count();
        $progressTickets = $ticket->where('status', 'Progress')->count();
        $solvedTickets = $ticket->where('status', 'Solved')->count();
        $onholdTickets = $ticket->where('status', 'onhold')->count();
        $allTickets = $ticket->count();

        return view('auth.dashboard', [
            "ticket" => $ticket,
            "Users" => $user,
            "openTickets" => $openTickets,
            "pendingTickets" => $pendingTickets,
            "progressTickets" => $progressTickets,
            "solvedTickets" => $solvedTickets,
            "onholdTickets" => $onholdTickets,
            "allTickets" => $allTickets,
            "ticketCounts" => compact('openTickets', 'pendingTickets', 'progressTickets', 'solvedTickets', 'onholdTickets', 'allTickets'),
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
