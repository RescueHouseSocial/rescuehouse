<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;

use App\Events\NotifyEvent;

use App\Models\User;
use App\Models\Message;

class MessageController extends Controller
{

  /**
   * Display a listing of the resource.
   */
  public function index(Request $request, $addresseeId = null): Response
  {

    //

  }

  /**
   * Show the refreshed data to the resource.
   */
  public function refresh(Request $request)
  {

    $threadId = $request->input("threadId");
    $messages = Message::join("users", "messages.messengerId", "=", "users.userId")
    ->leftJoin("avatars", "users.userId", "=", "avatars.userId")
    ->select("messages.*", "users.name", "avatars.path")
    ->where("messages.threadId", $threadId)
    ->where("avatars.active", 1)
    ->where("messages.active", 1)
    ->where("users.active", 1)
    ->orderBy("updated_at", "asc")
    ->get();

    return response()->json(["messages" => $messages, "message" => "Fresh Messages for you successfully"]);

  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request, $addresseeId = null)
  {

    $addressee = User::select("users.userId", "users.name", "avatars.path")
      ->leftJoin("avatars", "users.userId", "=", "avatars.userId")
      ->where("users.userId", $addresseeId)
      ->where("avatars.active", 1)
      ->where("users.active", 1)
      ->get();

    return Inertia::render("Messaging/New", [
      "addressee" => $addressee,
    ]);

  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {

    $uuid = Uuid::uuid4()->toString();
    $messengerId = Auth::user()->userId;
    $threadId = Uuid::uuid4()->toString();
    $body = $request->input("body");
    $message = new Message();
    $message->messageId = $uuid;
    $message->threadId = $threadId;
    $message->messengerId = $messengerId;
    $message->addresseeId = $messengerId;
    $message->body = $body;
    $message->save();
    event(new NotifyEvent("refresh"));
    return redirect("/messages/" . $threadId);

  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request, $threadId = null): Response
  {

    $userId = Auth::user()->userId;
    
    return Inertia::render("Messaging/Home", [
      "userId" => $userId,
      "threadId" => $threadId,
    ]);

  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Message $message)
  {

    //

  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Message $message)
  {

    $uuid = Uuid::uuid4()->toString();
    $messengerId = Auth::user()->userId;
    $threadId = $request->input("thread");
    $body = $request->input("body");
    $message = new Message();
    $message->messageId = $uuid;
    $message->threadId = $threadId;
    $message->messengerId = $messengerId;
    $message->addresseeId = $messengerId;
    $message->body = $body;
    $message->save();
    event(new NotifyEvent("refresh"));

  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Message $message)
  {

    //

  }

}
