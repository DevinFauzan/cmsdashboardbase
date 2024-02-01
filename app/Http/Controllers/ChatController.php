<?php

namespace App\Http\Controllers;

use \App\Models\Ticket;
use App\Http\Controllers\Controller;
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
        $messages = Chat::with('sender', 'receiver')
            ->where('ticket_id', $ticketId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json(['messages' => $messages]);
    }

    public function sendMessage(Request $request, $ticketId)
    {
        $ticket = Ticket::find($ticketId);

        // Ensure the ticket and associated user exist
        if ($ticket && $ticket->user) {
            Log::info('User ID from ticket: ' . $ticket->user->id);


            // Store the new message
            Chat::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $ticket->user->id, // Updated to use the user ID from the ticket
                'ticket_id' => $ticketId,
                'message' => $request->input('message'),
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Error sending message.']);
    }


    public function index($ticketId)
    {
        // Load messages for a specific ticket
        $messages = Chat::where('ticket_id', $ticketId)->orderBy('created_at', 'asc')->get();

        return response()->json(['messages' => $messages]);
    }

    public function store(Request $request, $ticketId)
    {
        // Store a new message
        $message = new Chat();
        $message->ticket_id = $ticketId;
        $message->sender_id = auth()->id(); // Assuming you have user authentication
        $message->message = $request->input('message');
        $message->save();

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
