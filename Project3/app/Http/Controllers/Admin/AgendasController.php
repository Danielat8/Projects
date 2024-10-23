<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\AnnualConference;
use App\Models\Event;



class AgendasController extends Controller
{
    public function index()
    {
        $agendas = Agenda::with(['event', 'conference'])->get();
        return view('admin.agendas.index', compact('agendas'));
    }

    public function create()
    {
        $conferences = AnnualConference::all();
        $events = Event::all();
        return view('admin.agendas.create', compact('conferences', 'events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'descriptions' => 'array|min:1',
            'descriptions.*' => 'required|string',
            'time' => 'required|date_format:H:i',
            'event_or_conference' => 'required|in:event,conference',
            'event_id' => 'required_if:event_or_conference,event|nullable|exists:events,id',
            'conference_id' => 'required_if:event_or_conference,conference|nullable|exists:annual_conferences,id',
        ]);

        $agendaData = [
            'title' => $request->input('title'),
            'time' => $request->input('time'),
            'description' => $request->input('description'),
            'event_id' => $request->input('event_id'),
            'conference_id' => $request->input('conference_id'),
        ];

        $agenda = Agenda::create($agendaData);

        foreach ($request->descriptions as $description) {
            if ($description) {
                $agenda->descriptions()->create(['description' => $description]);
            }
        }

        session()->flash('success', 'Agenda created successfully!');
        return redirect()->route('admin.agendas.index');
    }

    public function show($id)
    {
        $agenda = Agenda::findOrFail($id);
        return response()->json($agenda);
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        $conferences = AnnualConference::all();
        $events = Event::all();
        return view('admin.agendas.edit', compact('agenda', 'conferences', 'events'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'descriptions' => 'required|array|min:1',
            'descriptions.*' => 'required|string',
            'time' => 'required|date_format:H:i',
            'event_or_conference' => 'required|in:event,conference',
            'event_id' => $request->input('event_or_conference') === 'event' ? 'required|exists:events,id' : 'nullable',
            'conference_id' => $request->input('event_or_conference') === 'conference' ? 'required|exists:annual_conferences,id' : 'nullable',
        ]);

        $agenda = Agenda::findOrFail($id);


        $agenda->update($request->only(['title', 'description', 'time', 'event_id', 'conference_id']));

        $agenda->descriptions()->delete();
        foreach ($request->descriptions as $description) {
            if ($description) {
                $agenda->descriptions()->create(['description' => $description]);
            }
        }

        session()->flash('success', 'Agenda updated successfully!');
        return redirect()->route('admin.agendas.index');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return response()->json(null, 204);
    }
}
