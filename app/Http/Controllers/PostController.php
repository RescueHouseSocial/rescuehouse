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
use App\Models\Gallery;

class PostController extends Controller
{

  public function show(Request $request, $postId = null): Response
  {

    if ($postId) {
      $posts = Post::join("users", "posts.userId", "=", "users.userId")
        ->join("avatars", "users.userId", "=", "avatars.userId")
        ->leftjoin("galleries", "posts.postId", "=", "galleries.postId")
        ->where("posts.postId", $postId)
        ->where("posts.active", 1)
        ->where("users.active", 1)
        ->where("avatars.active", 1)
        ->select("posts.*", "users.name", "avatars.path")
        ->first();
      $galleryItems = Gallery::whereIn("galleryId", $posts->gallery)->get();
      $posts->galleries = $galleryItems;
      $loggedInUser = Auth::user();
      $relatedUsers = $loggedInUser->getRelatedUsers();
      return Inertia::render("Single", [
        "posts" => $posts,
        "users" => $relatedUsers,
      ]);
    } else {
      $uuid = Uuid::uuid4()->toString();
      $loggedInUser = Auth::user();
      $relatedUsers = $loggedInUser->getRelatedUsers();
      return Inertia::render("Post", [
        "postId" => $uuid,
        "users" => $relatedUsers,
      ]);
    }
    
  }

  public function store(Request $request)
  {

    $userId = Auth::user()->userId;
    $request->validate([
      "body" => "required",
    ]);
    $post = Post::create([
      "postId" => $request->postId,
      "userId" => $userId,
      "body" => $request->body,
      "datetime8601" => $request->datetime8601,
      "gallery" => $request->gallery,
    ]);
    return redirect("/post/" . $request->postId);
    
  }

}