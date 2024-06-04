<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('chat', ['users' => $users]);
    }

    // Fetch messages between authenticated user and selected user
    public function fetchMessages($userId)
    {
        $messages = \App\Models\Chat::where(function($query) use ($userId) {
                $query->where('from_user_id', Auth::id())->where('to_user_id', $userId);
            })->orWhere(function($query) use ($userId) {
                $query->where('from_user_id', $userId)->where('to_user_id', Auth::id());
            })->get();

        return response()->json($messages);
    }

    // Send message from authenticated user to selected user
    public function sendMessage(Request $request)
    {
        $message = \App\Models\Chat::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $request->to_user_id,
            'message' => $request->message
        ]);

        broadcast(new \App\Events\MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message sent!', 'message' => $message]);
    }

    // Pusher auth method
    public function pusherAuth(Request $request)
    {
        if (Auth::check()) {
            return \Illuminate\Support\Facades\Broadcast::auth($request);
        }

        return response('Unauthorized', 403);
    }
}
