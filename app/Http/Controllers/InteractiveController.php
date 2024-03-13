<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\Interactive;

class InteractiveController extends Controller
{

  public function store(Request $request)
  {

    $uuid = Uuid::uuid4()->toString();
    $userId = Auth::user()->userId;

    $request->validate([
      "body" => "required",
    ]);
    $post = Post::create([
      "postId" => $request->postId,
      "userId" => $userId,
      "body" => $request->body,
      "datetime8601" => $request->datetime8601,
      "type" => "interactive",
      "gallery" => $request->gallery,
    ]);

    $interactive = Interactive::create([
      "interactiveId" => $uuid,
      "postId" => $request->postId,
      "userId" => $userId,
      "datetime" => $request->datetime,
      "datetime8601" => $request->datetime8601,
      "duration" => $request->duration,
    ]);
    return redirect("/post/" . $request->postId);
    
  }

}