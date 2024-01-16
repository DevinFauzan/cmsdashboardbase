<?php

namespace App\Http\Controllers\Auth;
use App\Models\Ticket;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $ticket = Ticket::all();
        $user = User::all();

        return view('auth.dashboard',["ticket"=> $ticket, "Users" => $user]);
    }

    public function edit(Request $request, int $id)
    {
     $ticket = Ticket::find($id);
     
     if ($record) {
        abort(404, "Reoprd not found");
     }   
     $users = User::all();
     return view('auth.edit', compact('ticket', 'users'));

    }
}
