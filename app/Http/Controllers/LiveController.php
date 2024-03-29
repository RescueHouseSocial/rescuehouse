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

use App\Models\Live;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Interactive;

class LiveController extends Controller
{

  /**
   * Display a listing of the resource.
   */
  public function index()
  {

    //

  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {

    //

  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {

    //
    
  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request, $postId = null)
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

      if ($post->sessionId === "" || $post->sessionId === null) {
        $session = $opentok->createSession();
        $sessionId = $session->getSessionId();
        $interactive = Interactive::where("postId", $postId)->firstOrFail();
        $interactive->sessionId = $sessionId;
        $interactive->save();
      } else {
        $sessionId = $post->sessionId;
      }

      if($post->userId === $userId) {
        $token = $opentok->generateToken($sessionId, array(
          "role"                   => Role::MODERATOR,
          "expireTime"             => time()+(7 * 24 * 60 * 60),
          "data"                   => "name=RHS",
          "initialLayoutClassList" => array("focus")
        ));
      } else {
        $token = $opentok->generateToken($sessionId, array(
          "role"                   => Role::PUBLISHER,
          "expireTime"             => time()+(7 * 24 * 60 * 60),
          "data"                   => "name=RHS",
          "initialLayoutClassList" => array("focus")
        ));
      }

    }

    try {
      return Inertia::render("Live/Home", [
        "template" => "many",
        "postId" => $postId,
        "opentok_api_key" => $opentok_api_key,
        "sessionId" => $sessionId,
        "token" => $token,
      ]);
    } catch (\Throwable $e) {
      \Log::error("Error rendering page: " . $e->getMessage());
      return Inertia::render("Error", [
        "error" => "An error occurred while rendering the page. Please try again later."
      ])->toResponse(request());
    }

  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {

    //
    
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {

    //
    
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {

    //
    
  }

}
