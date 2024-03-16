<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;
use OpenTok\OpenTok;
use OpenTok\Session;
use OpenTok\Role;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\Interactive;

class InteractiveController extends Controller
{

  public function index(Request $request): Response
  {

    $posts = Post::join("interactives", "posts.postId", "=", "interactives.postId")
      ->where("posts.active", 1)
      ->where("posts.type", "interactive")
      ->get(["posts.*", "interactives.datetime"]);

    return Inertia::render("Interactive", [
      "posts" => $posts,
    ]);

  }

  public function show(Request $request, $postId = null): Response
  {

    $opentok_api_key = env("OPENTOK_API_KEY");
    $opentok_secret = env("OPENTOK_SECRET");
    $opentok = new OpenTok($opentok_api_key, $opentok_secret);
    $userId = Auth::user()->userId;

    $posts = Post::join("interactives", "posts.postId", "=", "interactives.postId")
      ->where("posts.postId", $postId)
      ->where("posts.active", 1)
      ->where("posts.type", "interactive")
      ->get(["posts.*", "interactives.datetime", "interactives.sessionId", "interactives.userId"]);

    foreach($posts as $post) {
      if($post->userId === $userId) {
        if($post->sessionId != "") {
          $token = $opentok->generateToken($post->sessionId, array(
            "role"                   => Role::MODERATOR,
            "expireTime"             => time()+(7 * 24 * 60 * 60),
            "data"                   => "name=RHS",
            "initialLayoutClassList" => array("focus")
          ));
        } else {
          $session = $opentok->createSession();
          $sessionId = $session->getSessionId();
          $interactive = Interactive::where("postId", $postId)->firstOrFail();
          $interactive->sessionId = $sessionId;
          $interactive->save();
          $token = $opentok->generateToken($sessionId, array(
            "role"                   => Role::MODERATOR,
            "expireTime"             => time()+(7 * 24 * 60 * 60),
            "data"                   => "name=RHS",
            "initialLayoutClassList" => array("focus")
          ));
        }
      } else {
        if($post->sessionId != "") {
          $token = $opentok->generateToken($post->sessionId, array(
            "role"                   => Role::PUBLISHER,
            "expireTime"             => time()+(7 * 24 * 60 * 60),
            "data"                   => "name=RHS",
            "initialLayoutClassList" => array("focus")
          ));
        } else {
          return redirect("/interactive");
        }
      }
    }

    return Inertia::render("Interactive", [
      "postId" => $postId,
      "posts" => $posts,
      "opentok_api_key" => $opentok_api_key,
      "sessionId" => $post->sessionId,
      "token" => $token,
    ]);

  }

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