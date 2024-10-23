<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\BoughtTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTicketsController extends Controller
{

    public function index()
    {

        $tickets = Ticket::where('available', '>', 0)->get();

        $boughtTicketIds = BoughtTicket::where('user_id', Auth::id())->pluck('ticket_id')->toArray();

        return view('user.tickets.index', compact('tickets', 'boughtTicketIds'));
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);


        $boughtTicketIds = BoughtTicket::where('user_id', Auth::id())->pluck('ticket_id')->toArray();

        return view('user.tickets.show', compact('ticket', 'boughtTicketIds'));
    }


    public function buy($id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->available <= 0) {
            return redirect()->route('user.tickets.index')->with('error', 'This ticket is no longer available.');
        }


        BoughtTicket::create([
            'user_id' => Auth::id(),
            'ticket_id' => $id,
        ]);


        $ticket->available--;
        $ticket->save();


        return redirect()->route('user.tickets.index')->with('success', 'You have successfully bought the ticket.');
    }
}
