<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Block;
use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class FriendsController extends Controller
{


    public function index()
    {

        $userId = Auth::id();
        $users = User::where('id', '!=', $userId)->get();


        $pendingRequestsReceived = Connection::where('friend_user_id', $userId)
            ->whereNull('connected_at')
            ->with('user')
            ->get();

        $pendingRequestsSent = Connection::where('user_id', $userId)
            ->whereNull('connected_at')
            ->get();


        $connections = Connection::where(function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->orWhere('friend_user_id', $userId);
        })
            ->whereNotNull('connected_at')
            ->get();


        $pendingRequestIdsReceived = $pendingRequestsReceived->pluck('user_id')->toArray();
        $pendingRequestIdsSent = $pendingRequestsSent->pluck('friend_user_id')->toArray();
        $connectionIds = $connections->pluck('friend_user_id')->toArray();
        $friendUserIds = $connections->pluck('user_id')->toArray();

        return view('user.friends.index', compact('users', 'pendingRequestsReceived', 'pendingRequestIdsReceived', 'pendingRequestIdsSent', 'connectionIds', 'friendUserIds'));
    }

    public function sendRequest(Request $request)
    {
        $connection = Connection::create([
            'user_id' => Auth::id(),
            'friend_user_id' => $request->friend_user_id
        ]);

        return response()->json(['message' => 'Friend request sent!']);
    }

    public function acceptRequest($id)
    {
        try {
            $connection = Connection::findOrFail($id);

            $connection->connected_at = now();
            $connection->save();

            return response()->json(['message' => 'Friend request accepted!']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Request not found.'], 404);
        } catch (\Exception $e) {
            Log::error('Error accepting friend request: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to accept friend request.'], 500);
        }
    }

    public function rejectRequest($id)
    {
        try {
            $connection = Connection::findOrFail($id);
            $connection->delete();

            return response()->json(['message' => 'Friend request rejected!']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Request not found.'], 404);
        } catch (\Exception $e) {
            Log::error('Error rejecting friend request: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to reject friend request.'], 500);
        }
    }
    public function unfriend(Request $request)
    {
        try {
            $connection = Connection::where(function ($query) use ($request) {
                $query->where('user_id', Auth::id())
                    ->where('friend_user_id', $request->friend_user_id);
            })->orWhere(function ($query) use ($request) {
                $query->where('user_id', $request->friend_user_id)
                    ->where('friend_user_id', Auth::id());
            })->first();

            if ($connection) {
                $connection->delete();
                return response()->json(['message' => 'You are no longer friends!']);
            } else {
                return response()->json(['message' => 'Friendship not found.'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error unfriending: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to unfriend.'], 500);
        }
    }
    // for admin 
    public function banUser(Request $request, $id)
    {

        $request->validate([
            'days' => 'required|integer|min:1|max:30',
        ]);


        $user = User::findOrFail($id);


        if (Auth::user()->role_id == 1 && $user->role_id != 1) {
            $banDuration = (int) $request->input('days');

            $banEndDate = Carbon::now()->addDays($banDuration);


            $user->ban_end_date = $banEndDate;
            $user->is_banned = true;
            $user->save();

            return response()->json(['message' => "User banned for {$banDuration} days."]);
        }

        return response()->json(['message' => 'You cannot ban an admin or yourself.'], 403);
    }

    public function unbanUser($id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->role_id == 1 && $user->role_id != 1) {

            $user->is_banned = false;
            $user->ban_end_date = null;
            $user->save();

            return response()->json(['message' => 'User unbanned.']);
        }

        return response()->json(['message' => 'You cannot unban an admin or yourself.'], 403);
    }
    // for user
    public function blockUser($id)
    {
        $blockedUserId = $id;
        $userId = Auth::id();

        $existingBlock = Block::where('user_id', $userId)
            ->where('blocked_user_id', $blockedUserId)
            ->first();

        if (!$existingBlock) {
            Block::create([
                'user_id' => $userId,
                'blocked_user_id' => $blockedUserId,
            ]);
            return response()->json(['message' => 'User blocked successfully.']);
        } else {
            return response()->json(['message' => 'User is already blocked.'], 400);
        }
    }

    public function unblockUser($id)
    {
        $blockedUserId = $id;
        $userId = Auth::id();

        $existingBlock = Block::where('user_id', $userId)
            ->where('blocked_user_id', $blockedUserId)
            ->first();

        if ($existingBlock) {
            $existingBlock->delete();
            return response()->json(['message' => 'User unblocked successfully.']);
        } else {
            return response()->json(['message' => 'User is not blocked.'], 400);
        }
    }
}
