<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { {
            return view('pages.user_complainant.user_dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return view('pages.user_complainant.my_ticket');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_user' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'complained_date' => 'required|date',
            'description' => 'required|string',
            'subject' => 'required|string|max:255',
            'product' => 'required|in:0,1,2,3',
            'phone' => 'required|numeric',
        ]);

        $product = $request->input('product');
        $productPrefix = ''; // Initialize an empty prefix

        // Determine the prefix and counter based on the selected product
        switch ($product) {
            case 0:
                $productPrefix = 'TS';
                break;
            case 1:
                $productPrefix = 'TO';
                break;
            case 2:
                $productPrefix = 'TD';
                break;
            case 3:
                $productPrefix = 'TP';
                break;
        }

        // Find the latest ticket with the same product prefix
        $latestTicket = Ticket::where('ticket_id', 'like', $productPrefix . '%')->latest()->first();

        // Generate the new ticket ID
        if ($latestTicket) {
            $ticketIdNumber = intval(substr($latestTicket->ticket_id, strlen($productPrefix))) + 1;
        } else {
            $ticketIdNumber = 1;
        }

        $newTicketId = $productPrefix . str_pad($ticketIdNumber, 5, '0', STR_PAD_LEFT);

        // Create a new ticket using the Ticket model
        Ticket::create([
            'name_user' => $request->input('name_user'),
            'email' => $request->input('email'),
            'complained_date' => $request->input('complained_date'),
            'description' => $request->input('description'),
            'subject' => $request->input('subject'),
            'product' => $product,
            'phone' => $request->input('phone'),
            'status' => 'Open',
            'ticket_id' => $newTicketId,
        ]);

        $password = Str::random(8);

        // Create a new user
        $user = User::create([
            'name' => $request->input('name_user'),
            'email' => $request->input('email'),
            'password' => bcrypt($password),
            'role' => 'user',
        ]);

        $request->session()->flash('newTicketInfo', [
            'ticket_id' => $newTicketId,
            'name_user' => $request->input('name_user'),
            'email' => $request->input('email'),
            'password' => $password,
        ]);

        return redirect()->route('dashboard-user.index')->with('success', 'Ticket submitted successfully!');
    }

    public function myTickets()
    {
        // Retrieve the authenticated user's email
        $userEmail = Auth::user()->email;

        // Fetch tickets associated with the user's email
        $userTickets = Ticket::where('email', $userEmail)->latest()->get();

        return view('pages.user_complainant.my_ticket', [
            'allTickets' => $userTickets,
        ]);
    }

    public function showNewTicketForm($userEmail)
    {
        $user = User::find($userEmail);

        return view('pages.user_complainant.new_ticket', [
            'user' => $user,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // return view('pages.user_complainant.detail_ticket_user');
        // return view('pages.user_complainant.new_ticket');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);

        return view('pages.user_complainant.detail_ticket_user', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
