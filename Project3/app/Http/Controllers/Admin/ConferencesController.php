<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnnualConference;

class ConferencesController extends Controller
{
    public function index()
    {
        $conferences = AnnualConference::all();
        return view('admin.conferences.index', compact('conferences'));
    }


    public function create()
    {
        return view('admin.conferences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'theme' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'objective' => 'required|string|max:255',
            'agenda' => 'required|string',
            'status' => 'required|string|max:50',
        ]);

        AnnualConference::create($request->all());
        session()->flash('success', 'Conference create successfully!');


        return redirect()->route('admin.conferences.index');
    }

    public function show($id)
    {
        $conference = AnnualConference::findOrFail($id);
        return response()->json($conference);
    }

    public function edit($id)
    {
        $conference = AnnualConference::findOrFail($id);
        return view('admin.conferences.edit', compact('conference'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'theme' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'objective' => 'required|string|max:255',
            'agenda' => 'required|string',
            'status' => 'required|string|max:50',
        ]);

        $conference = AnnualConference::findOrFail($id);
        $conference->update($request->all());
        session()->flash('success', 'Conference updated successfully!');


        return redirect()->route('admin.conferences.index');
    }


    public function destroy($id)
    {
        $conference = AnnualConference::findOrFail($id);
        $conference->delete();
        return response()->json(null, 204);
    }
}
