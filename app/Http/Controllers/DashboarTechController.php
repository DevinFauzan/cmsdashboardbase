<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;

class DashboarTechController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        $users = User::all();
        $user = Auth::user();
        $tickets = Ticket::where('name_tech', $user->name)->get();

        return view('pages.tech_person.dashboard_techperson',["ticket"=> $tickets], compact('tickets', 'users'));
    }
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:Progress,Pending,Solved',
        ]);

        $ticket->update(['status' => $request->input('status')]);

        return redirect()->back()->with('success', 'Ticket status updated successfully');
    }

    public function refreshTableTechPerson()
    {
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        // Filter tickets based on the authenticated user's name
        $tickets = Ticket::where('name_tech', $user->name)->get();
        $html = view('partials.table_tech_person', compact('tickets'))->render();

        return response()->json(['html' => $html]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('pages.tech_person.detail_ticket');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

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

    public function edit($id)
    {
        $ticket = Ticket::find($id);

        return view('pages.tech_person.detail_ticket', compact('ticket'));
    }
}
