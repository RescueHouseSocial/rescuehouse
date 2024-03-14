<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Avatar;
use App\Models\Post;
use App\Models\Rescue;

class RescueController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    
    $posts = Post::join("users", "posts.userId", "=", "users.userId")
      ->leftJoin("avatars", "users.userId", "=", "avatars.userId")
      ->where("posts.type", "rescue")
      ->where("posts.active", 1)
      ->select("posts.*", "users.name", "avatars.path")
      ->inRandomOrder()
      ->limit(2)
      ->distinct()
      ->get();

    return response()->json(["posts" => $posts, "message" => "Got posts successful"]);

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
      "type" => "rescue",
      "gallery" => $request->gallery,
    ]);

    $rescue = Rescue::create([
      "rescueId" => $uuid,
      "postId" => $request->postId,
      "userId" => $userId,
      "datetime8601" => $request->datetime8601,
    ]);
    return redirect("/post/" . $request->postId);

  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
  //
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
