<?php

namespace App\Http\Controllers;

use \App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getMessages($ticketId)
    {
        $messages = Chat::where('ticket_id', $ticketId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json(['messages' => $messages]);
    }

    public function index($ticketId)
    {
        Log::info('Fetching messages for ticket ID: ' . $ticketId);
    
        // Load messages for a specific ticket
        $messages = Chat::where('ticket_id', $ticketId)->orderBy('created_at', 'asc')->get();
    
        Log::info('Fetched messages: ' . json_encode($messages));
    
        return response()->json(['messages' => $messages]);
    }
    


    public function store(Request $request, $ticketId)
    {
        DB::enableQueryLog();

        // Find the ticket and load the associated user
        $ticket = Ticket::with('user')->find($ticketId);

        // Log the ticket ID and associated user ID
        Log::info('Ticket ID: ' . $ticketId);
        Log::info('Ticket User ID: ' . optional($ticket->user)->id);

        // Ensure the ticket and associated user exist
        if ($ticket && $ticket->user) {
            // Use Eloquent relationship to save the new message
            $ticket->messages()->create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $ticket->user->id,
                'message' => $request->input('message'),
            ]);

            // Log successful message creation
            Log::info('Message sent successfully');

            return response()->json(['success' => true]);
        }

        // If ticket or user is not found, log an error
        Log::error('Ticket or user not found');

        // Fall back to the original store logic
        // Store a new message
        $message = new Chat();
        $message->ticket_id = $ticketId;
        $message->sender_id = auth()->id();
        $message->receiver_id = optional($ticket->user)->id; // Use optional() to handle null case
        Log::info('Receiver ID: ' . $message->receiver_id);
        $message->message = $request->input('message');
        $message->save();

        // Log successful message creation
        Log::info('Message sent successfully');

        return response()->json(['message' => 'Message sent successfully']);
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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
