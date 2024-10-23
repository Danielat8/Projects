<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\AnnualConference;
use App\Models\Event;


class TicketsController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['event', 'conference'])->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        $conferences = AnnualConference::all();
        $events = Event::all();
        return view('admin.tickets.create', compact('conferences', 'events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ticket_type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'available' => 'required|integer|min:0',
            'ticket_name' => 'required|string|max:255',
            'ticket_date' => 'required|date',
            'place' => 'required|string|max:255',
            'event_or_conference' => 'required|in:event,conference',
            'event_id' => 'required_if:event_or_conference,event|nullable|exists:events,id',
            'conference_id' => 'required_if:event_or_conference,conference|nullable|exists:annual_conferences,id',
        ]);


        $ticketData = [
            'ticket_type' => $request->input('ticket_type'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'available' => $request->input('available'),
            'ticket_name' => $request->input('ticket_name'),
            'ticket_date' => $request->input('ticket_date'),
            'place' => $request->input('place'),
        ];

        if ($request->input('event_or_conference') === 'event') {
            $ticketData['event_id'] = $request->input('event_id');
            $ticketData['conference_id'] = null;
        } else {
            $ticketData['conference_id'] = $request->input('conference_id');
            $ticketData['event_id'] = null;
        }

        Ticket::create($ticketData);

        session()->flash('success', 'Ticket created successfully!');
        return redirect()->route('admin.tickets.index');
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $conferences = AnnualConference::all();
        $events = Event::all();
        return view('admin.tickets.edit', compact('ticket', 'conferences', 'events'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ticket_type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'available' => 'required|integer|min:0',
            'ticket_name' => 'required|string|max:255',
            'ticket_date' => 'required|date',
            'place' => 'required|string|max:255',
            'event_or_conference' => 'required|in:event,conference',
            'event_id' => $request->input('event_or_conference') === 'event' ? 'required|exists:events,id' : 'nullable',
            'conference_id' => $request->input('event_or_conference') === 'conference' ? 'required|exists:annual_conferences,id' : 'nullable',
        ]);

        $ticket = Ticket::findOrFail($id);


        $ticket->update([
            'ticket_type' => $request->input('ticket_type'),
            'ticket_name' => $request->input('ticket_name'),
            'ticket_date' => $request->input('ticket_date'),
            'place' => $request->input('place'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'available' => $request->input('available'),
        ]);
        if ($request->input('event_or_conference') === 'event') {
            $ticket->event_id = $request->input('event_id');
            $ticket->conference_id = null;
        } else {
            $ticket->conference_id = $request->input('conference_id');
            $ticket->event_id = null;
        }

        $ticket->update($request->only(['ticket_type', 'price', 'quantity', 'available']));

        session()->flash('success', 'Ticket updated successfully!');
        return redirect()->route('admin.tickets.index');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return response()->json(null, 204);
    }
}
