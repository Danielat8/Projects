<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Recommendation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class RecommendationsController extends Controller
{
    public function myRecommendations()
    {
        $myRecommendations = Recommendation::where('from_user_id', Auth::id())->get();
        return response()->json(['myRecommendations' => $myRecommendations]);
    }
    public function receivedRecommendations()
    {
        $receivedRecommendations = Recommendation::with(['fromUser', 'forUser'])
            ->where('for_user_id', Auth::id())
            ->get();

        Log::info($receivedRecommendations);

        return response()->json(['receivedRecommendations' => $receivedRecommendations]);
    }



    public function index()
    {
        $myRecommendations = Recommendation::where('from_user_id', Auth::id())->get();

        $receivedRecommendations = Recommendation::where('for_user_id', Auth::id())->get();

        $users = User::where('id', '!=', Auth::id())->get();

        return view('user.recommendations.index', [
            'myRecommendations' => $myRecommendations,
            'receivedRecommendations' => $receivedRecommendations,
            'users' => $users,
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        try {
            $recommendation = Recommendation::where('from_user_id', Auth::id())->findOrFail($id);
            $recommendation->update(['description' => $request->description]);

            return response()->json(['success' => true, 'message' => 'Recommendation updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Recommendation not found or update failed.'], 404);
        }
    }



    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'for_user_id' => 'required|exists:users,id',
        ]);
        Recommendation::create([
            'from_user_id' => Auth::id(),
            'description' => $request->description,
            'for_user_id' => $request->for_user_id,
        ]);

        return redirect()->route('user.recommendations.index')->with('success', 'Recommendation created successfully.');
    }

    public function edit($id)
    {
        $recommendation = Recommendation::where('from_user_id', Auth::id())->findOrFail($id);

        return view('user.recommendations.edit', compact('recommendation'));
    }



    public function destroy($id)
    {

        $recommendation = Recommendation::findOrFail($id);

        if ($recommendation->from_user_id === Auth::id() || $recommendation->for_user_id === Auth::id()) {
            $recommendation->delete();

            return redirect()->route('user.recommendations.index')->with('success', 'Recommendation deleted successfully.');
        }

        return redirect()->route('user.recommendations.index')->with('error', 'Unauthorized action.');
    }
}
