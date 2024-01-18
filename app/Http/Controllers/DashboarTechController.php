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
    
        $newStatus = $request->input('status');
    
        // If the status is changed to "Solved"
        if ($newStatus == 'Solved') {
            // Decrement the case_total in the User model
            $user = User::where('name', $ticket->name_tech)->first();
            if ($user) {
                $user->decrement('case_total');
    
                // Update user status based on case_total
                $this->updateUserStatus($user);
            }
        // } else {
        //     // If the status is changed from "Solved"
        //     // Increment the case_total in the User model
        //     $user = User::where('name', $ticket->name_tech)->first();
        //     if ($user) {
        //         $user->increment('case_total');
    
        //         // Update user status based on case_total
        //         $this->updateUserStatus($user);
        //     }
        }
    
        // Update ticket status
        $ticket->update(['status' => $newStatus]);
    
        return redirect()->back()->with('success', 'Ticket status updated successfully');
    }
    
    private function updateUserStatus(User $user)
    {
        if ($user->case_total === 0) {
            $user->status = 0; // Free
        } elseif ($user->case_total >= 1 && $user->case_total <= 2) {
            $user->status = 1; // Working
        } elseif ($user->case_total >= 3 && $user->case_total <= 5) {
            $user->status = 2; // Busy
        } elseif ($user->case_total > 5) {
            $user->status = 3; // Overload
        }
    
        $user->save();
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
