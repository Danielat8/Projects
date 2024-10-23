<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;


class EventsController extends Controller
{

    public function index()
    {

        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }


    public function create()
    {
        return view('admin.events.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'theme' => 'required|string|max:255',
            'description' => 'required|string',
            'objective' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'picture_path' => 'required|string',
        ]);
        $eventData = $request->all();

        if (isset($eventData['picture_path']) && !empty($eventData['picture_path'])) {
            if (filter_var($eventData['picture_path'], FILTER_VALIDATE_URL)) {

                $eventData['picture_path'] = $eventData['picture_path'];
            } else {

                $eventData['picture_path'] = $eventData['picture_path'];
            }
        }

        Event::create($eventData);


        session()->flash('success', 'Event created successfully!');
        return redirect()->route('admin.events.index');
    }


    public function edit($id)
    {

        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }


    public function show($id)
    {

        $event = Event::findOrFail($id);
        return response()->json($event);
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'theme' => 'required|string|max:255',
            'description' => 'required|string',
            'objective' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'picture_path' => 'required|string',

        ]);


        $event = Event::findOrFail($id);

        $event->update($request->all());


        session()->flash('success', 'Event updated successfully!');
        return redirect()->route('admin.events.index');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(null, 204);
    }
}
