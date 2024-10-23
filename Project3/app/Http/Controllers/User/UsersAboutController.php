<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserAbout;
use Illuminate\Support\Facades\Storage;

class UsersAboutController extends Controller
{
    public function show($id)
    {

        $user = User::with('about', 'givenRecommendations')->findOrFail($id);

        return view('user.usersabout.show', compact('user'));
    }
    public function index()
    {
        $aboutUsers = UserAbout::with('user')->get();
        return view('user.usersabout.index', compact('aboutUsers'));
    }

    public function create()
    {
        return view('user.usersabout.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'surname' => 'required|string|max:255',
            'bio' => 'required|string',
            'title' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'cv_upload' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'photo_upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('cv_upload')) {
            $data['cv_upload'] = $request->file('cv_upload')->store('cv_uploads', 'public');
        }

        if ($request->hasFile('photo_upload')) {
            $data['photo_upload'] = $request->file('photo_upload')->store('photo_uploads', 'public');
        }

        UserAbout::create($data);

        session()->flash('success', 'Your information has been added successfully!');
        return redirect()->route('user.usersabout.index');
    }

    public function edit($id)
    {
        $aboutUser = UserAbout::where('user_id', Auth::id())->findOrFail($id);
        return view('user.usersabout.edit', compact('aboutUser'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'surname' => 'required|string|max:255',
            'bio' => 'required|string',
            'title' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'cv_upload' => 'required|file|mimes:pdf|max:2048',
            'photo_upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $aboutUser = UserAbout::where('user_id', Auth::id())->findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('cv_upload')) {
            if ($aboutUser->cv_upload && Storage::disk('public')->exists($aboutUser->cv_upload)) {
                Storage::disk('public')->delete($aboutUser->cv_upload);
            }
            $data['cv_upload'] = $request->file('cv_upload')->store('cv_uploads', 'public');
        }

        if ($request->hasFile('photo_upload')) {
            if ($aboutUser->photo_upload && Storage::disk('public')->exists($aboutUser->photo_upload)) {
                Storage::disk('public')->delete($aboutUser->photo_upload);
            }
            $data['photo_upload'] = $request->file('photo_upload')->store('photo_uploads', 'public');
        }

        $aboutUser->update($data);

        session()->flash('success', 'Your information has been updated successfully!');
        return redirect()->route('user.usersabout.index');
    }

    public function destroy($id)
    {
        $aboutUser = UserAbout::where('user_id', Auth::id())->findOrFail($id);


        if ($aboutUser->cv_upload && Storage::disk('public')->exists($aboutUser->cv_upload)) {
            Storage::disk('public')->delete($aboutUser->cv_upload);
        }

        if ($aboutUser->photo_upload && Storage::disk('public')->exists($aboutUser->photo_upload)) {
            Storage::disk('public')->delete($aboutUser->photo_upload);
        }

        $aboutUser->delete();
        return response()->json(null, 204);

        return redirect()->route('user.usersabout.index');
    }

    public function showcv($id)
    {
        $aboutUser = UserAbout::findOrFail($id);
        return response()->download(storage_path("app/public/{$aboutUser->cv_upload}"));
    }
}
