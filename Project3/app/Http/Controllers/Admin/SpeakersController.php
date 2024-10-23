<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventSpeaker;
use App\Models\Event;
use App\Models\AnnualConference;


class SpeakersController extends Controller
{
    public function index()
    {
        $speakers = EventSpeaker::with(['event', 'conference'])->get();

        return view('admin.speakers.index', compact('speakers'));
    }


    public function create()
    {

        $events = Event::all();
        $conferences = AnnualConference::all();

        return view('admin.speakers.create', compact('events', 'conferences'));
    }
    public function show($id)
    {
        $speaker = EventSpeaker::findOrFail($id);
        return response()->json($speaker);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'type' => 'required|in:speaker,special_guest',
            'image' => 'required|string',
            'linkedin' => 'required|url',
            'event_or_conference' => 'required|in:event,conference',
            'event_id' => 'required_if:event_or_conference,event|nullable|exists:events,id',
            'conference_id' => 'required_if:event_or_conference,conference|nullable|exists:annual_conferences,id',
        ]);


        $speakersData = [
            'name' => $request->input('name'),
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'image' => $request->input('image'),
            'linkedin' => $request->input('linkedin'),
        ];

        if ($request->input('event_or_conference') === 'event') {
            $speakersData['event_id'] = $request->input('event_id');
            $speakersData['conference_id'] = null;
        } else {
            $speakersData['conference_id'] = $request->input('conference_id');
            $speakersData['event_id'] = null;
        }
        if (isset($speakersData['image']) && !empty($speakersData['image'])) {
            if (filter_var($speakersData['image'], FILTER_VALIDATE_URL)) {

                $speakersData['image'] = $speakersData['image'];
            } else {

                $speakersData['image'] = $speakersData['image'];
            }
        }

        EventSpeaker::create($speakersData);

        return redirect()->route('admin.speakers.index')->with('success', 'Speaker created successfully!');
    }




    public function edit($id)
    {

        $speaker = EventSpeaker::findOrFail($id);
        $conferences = AnnualConference::all();
        $events = Event::all();
        return view('admin.speakers.edit', compact('speaker', 'events', 'conferences'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'type' => 'required|in:speaker,special_guest',
            'image' => 'required|string',
            'linkedin' => 'required|url',
            'event_or_conference' => 'required|in:event,conference',
            'event_id' => $request->input('event_or_conference') === 'event' ? 'required|exists:events,id' : 'nullable',
            'conference_id' => $request->input('event_or_conference') === 'conference' ? 'required|exists:annual_conferences,id' : 'nullable',
        ]);

        $speaker = EventSpeaker::findOrFail($id);
        if ($request->input('event_or_conference') === 'event') {
            $speaker->event_id = $request->input('event_id');
            $speaker->conference_id = null;
        } else {
            $speaker->conference_id = $request->input('conference_id');
            $speaker->event_id = null;
        }

        $speaker->update($request->all());

        session()->flash('success', 'Speaker updated successfully!');
        return redirect()->route('admin.speakers.index');
    }


    public function destroy($id)
    {
        $speaker = EventSpeaker::findOrFail($id);
        $speaker->delete();

        return response()->json(null, 204);
    }
}
