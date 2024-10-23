<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;
use App\Models\UserAbout;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserSettingsController extends Controller
{
    public function index()
    {

        $settings = UserActivityLog::where('user_id', Auth::id())->first();


        $jobs = UserActivityLog::select('job')->distinct()->get();
        $userAbout = UserAbout::where('user_id', Auth::id())->first();
        $user = User::findOrFail(Auth::id());
        return view('user.settings.setting', compact('settings', 'jobs', 'user', 'userAbout'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'notification_target_preference' => 'nullable|string',
            'notification_topic_preference' => 'nullable|string',
            'job' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:8|confirmed',
            'surname' => 'required|string|max:255',
        ]);
        $user = User::findOrFail(Auth::id());
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {

            $user->password = Hash::make($request->input('password'));
        }
        $user->save();
        UserAbout::updateOrCreate(
            ['user_id' => Auth::id()],
            ['surname' => $request->input('surname')]
        );

        UserActivityLog::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'notification_target_preference' => $request->input('notification_target_preference'),
                'notification_topic_preference' => $request->input('notification_topic_preference'),
                'job' => $request->input('job'),
            ]
        );

        return redirect()->route('user.settings.setting')->with('success', 'Settings updated successfully.');
    }
}
