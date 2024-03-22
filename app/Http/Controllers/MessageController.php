<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Message;

class MessageController extends Controller
{

  /**
   * Display a listing of the resource.
   */
  public function index(Request $request, $addresseeId = null): Response
  {

    // $userId = Auth::user()->userId;
    // $messengerId = Auth::user()->userId;

    // $addressee = User::select("users.name", "avatars.path")
    //   ->leftJoin("avatars", "users.userId", "=", "avatars.userId")
    //   ->where("users.userId", $addresseeId)
    //   ->where("users.active", 1)
    //   ->get();

    // $message = Message::join("users", "messages.messengerId", "=", "users.userId")
    //   ->leftJoin("avatars", "users.userId", "=", "avatars.userId")
    //   ->select("messages.*", "users.name", "avatars.path")
    //   ->where("messages.threadId", $threadId)
    //   ->where("messages.active", 1)
    //   ->where("users.active", 1)
    //   ->orderBy("updated_at", "asc")
    //   ->get();

    // $messages = Message::select(DB::raw("MAX(id) as id"))
    //   ->where("messengerId", $messengerId)
    //   ->where("active", 1)
    //   ->groupBy("threadId")
    //   ->orderBy("updated_at", "desc")
    //   ->get();
    // $groupByMessages = Message::whereIn("id", $messages->pluck("id"))->get();

    // return Inertia::render("Message", [
    //   "addressee" => $addressee,
    //   "userId" => $userId,
    //   "message" => $message,
    //   "messages" => $groupByMessages,
    // ]);

  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request, $addresseeId = null)
  {

    $addressee = User::select("users.userId", "users.name", "avatars.path")
      ->leftJoin("avatars", "users.userId", "=", "avatars.userId")
      ->where("users.userId", $addresseeId)
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

    $status = $request->input("status");
    if ($status === "new") {
      $threadId = Uuid::uuid4()->toString();
    } else {
      $threadId = $request->input("thread");
    }
    $uuid = Uuid::uuid4()->toString();
    $messengerId = Auth::user()->userId;
    $body = $request->input("body");
    $message = new Message();
    $message->messageId = $uuid;
    $message->threadId = $threadId;
    $message->messengerId = $messengerId;
    $message->addresseeId = $messengerId;
    $message->body = $body;
    $message->save();
    return redirect("/messages/" . $threadId);

  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request, $threadId = null): Response
  {

    $userId = Auth::user()->userId;
    // $messengerId = Auth::user()->userId;

    $messages = Message::join("users", "messages.messengerId", "=", "users.userId")
      ->leftJoin("avatars", "users.userId", "=", "avatars.userId")
      ->select("messages.*", "users.name", "avatars.path")
      ->where("messages.threadId", $threadId)
      ->where("messages.active", 1)
      ->where("users.active", 1)
      ->orderBy("updated_at", "asc")
      ->get();

    // $messages = Message::select(DB::raw("MAX(id) as id"))
    //   ->where("messengerId", $messengerId)
    //   ->where("active", 1)
    //   ->groupBy("threadId")
    //   ->orderBy("updated_at", "desc")
    //   ->get();
    // $groupByMessages = Message::whereIn("id", $messages->pluck("id"))->get();

    // return Inertia::render("Message", [
    //   "userId" => $userId,
    //   "message" => $message,
    //   "messages" => $groupByMessages,
    // ]);

    // $messages = Message::select("messages.*")
    //   ->where("threadId", $threadId)
    //   ->where("active", 1)
    //   ->get();

    return Inertia::render("Messaging/Home", [
        "userId" => $userId,
        "messages" => $messages,
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

    //

  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Message $message)
  {

    //

  }

}
