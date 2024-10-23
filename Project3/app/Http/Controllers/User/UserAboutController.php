<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserAboutController extends Controller
{

    public function index()
    {
        $userAbouts = User::with('userAbout')->get();
        return response()->json($userAbouts);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'surname' => 'required|string|max:255',
            'bio' => 'required|string',
            'title' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'cv_upload' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'photo_upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $cvPath = $request->file('cv_upload') ? $request->file('cv_upload')->store('uploads/cvs', 'public') : null;
        $photoPath = $request->file('photo_upload') ? $request->file('photo_upload')->store('uploads/photos', 'public') : null;

        $user = User::findOrFail($request->user()->id);

        $user->userAbout()->updateOrCreate([], [
            'surname' => $validatedData['surname'],
            'bio' => $validatedData['bio'],
            'title' => $validatedData['title'],
            'phone' => $validatedData['phone'],
            'city' => $validatedData['city'],
            'country' => $validatedData['country'],
            'cv_upload' => $cvPath,
            'photo_upload' => $photoPath,
        ]);


        return redirect()->route('user.userpanel')->with('success', 'User information saved successfully.');
    }

    public function update(Request $request, $id)
    {
        $user = User::with('userAbout')->findOrFail($id);
        $userAbout = $user->userAbout;

        $validatedData = $request->validate([
            'surname' => 'required|string|max:255',
            'bio' => 'required|string',
            'title' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'cv_upload' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'photo_upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $cvPath = $request->file('cv_upload') ? $request->file('cv_upload')->store('uploads/cvs', 'public') : $userAbout->cv_upload;
        $photoPath = $request->file('photo_upload') ? $request->file('photo_upload')->store('uploads/photos', 'public') : $userAbout->photo_upload;


        $userAbout->update([
            'surname' => $validatedData['surname'],
            'bio' => $validatedData['bio'],
            'title' => $validatedData['title'],
            'phone' => $validatedData['phone'],
            'city' => $validatedData['city'],
            'country' => $validatedData['country'],
            'cv_upload' => $cvPath,
            'photo_upload' => $photoPath,
        ]);


        return redirect()->route('user.userpanel')->with('success', 'User information updated successfully.');
    }
}
