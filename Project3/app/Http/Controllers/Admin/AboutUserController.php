<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserAbout;
use Illuminate\Support\Facades\Storage;

class AboutUserController extends Controller
{
    public function index()
    {
        $aboutUsers = UserAbout::with('user')->get();
        return view('admin.aboutuser.index', compact('aboutUsers'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.aboutuser.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
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

        if ($request->hasFile('cv_upload')) {
            $data['cv_upload'] = $request->file('cv_upload')->store('cv_uploads', 'public');
        }

        if ($request->hasFile('photo_upload')) {
            $data['photo_upload'] = $request->file('photo_upload')->store('photo_uploads', 'public');
        }

        UserAbout::create($data);

        session()->flash('success', 'User information added successfully!');
        return redirect()->route('admin.aboutuser.index');
    }

    public function edit($id)
    {
        $aboutUser = UserAbout::findOrFail($id);
        $users = User::all();
        return view('admin.aboutuser.edit', compact('aboutUser', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'surname' => 'required|string|max:255',
            'bio' => 'required|string',
            'title' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'cv_upload' => 'required|file|mimes:pdf|max:2048',
            'photo_upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $aboutUser = UserAbout::findOrFail($id);
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

        session()->flash('success', 'User information updated successfully!');
        return redirect()->route('admin.aboutuser.index');
    }


    public function destroy($id)
    {
        $aboutUser = UserAbout::findOrFail($id);


        if ($aboutUser->cv_upload && Storage::disk('public')->exists($aboutUser->cv_upload)) {
            Storage::disk('public')->delete($aboutUser->cv_upload);
        }

        if ($aboutUser->photo_upload && Storage::disk('public')->exists($aboutUser->photo_upload)) {
            Storage::disk('public')->delete($aboutUser->photo_upload);
        }

        $aboutUser->delete();

        return response()->json(null, 204);
    }

    public function showcv($id)
    {
        $aboutUser = UserAbout::findOrFail($id);
        return response()->download(storage_path("app/public/{$aboutUser->cv_upload}"));
    }
}
