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
use App\Models\Reply;
use App\Models\Favorite;

class PostController extends Controller
{

  public function show(Request $request, $postId = null): Response
  {

    if ($postId) {
      $loggedInUser = Auth::user();
      $relatedUsers = $loggedInUser->getRelatedUsers();
      $posts = Post::join("users", "posts.userId", "=", "users.userId")
        ->leftJoin("avatars", "users.userId", "=", "avatars.userId")
        ->leftjoin("galleries", "posts.postId", "=", "galleries.postId")
        ->leftJoin("favorites", function($join) {
          $join->on("posts.postId", "=", "favorites.postId")
            ->where("favorites.userId", "=", auth()->user()->userId)
            ->where("favorites.active", "=", 1);
        })
        ->where("posts.postId", $postId)
        ->where("posts.active", 1)
        ->where("users.active", 1)
        ->select("posts.*", "users.name", "avatars.path")
        ->first();
      $galleryItems = Gallery::whereIn("galleryId", $posts->gallery)->get();
      $posts->galleries = $galleryItems;
      $replies = Reply::join("users", "replies.userId", "=", "users.userId")
        ->leftJoin("avatars", "users.userId", "=", "avatars.userId")
        ->where("replies.postId", $postId)
        ->where("replies.active", 1)
        ->where("users.active", 1)
        ->select("replies.*", "users.name", "avatars.path")
        ->orderBy("replies.created_at", "desc")
        ->get();
      $repliescount = Reply::where("postId", $postId)
        ->where("active", 1)
        ->count();
      $posts->repliescount = $repliescount;
      $favorites = Favorite::where("postId", $postId)
        ->where("userId", auth()->user()->userId)
        ->where("active", 1)
        ->get();
      $posts->favorites = $favorites;
      $favoritescount = Favorite::where("postId", $postId)
        ->where("userId", auth()->user()->userId)
        ->where("active", 1)
        ->count();
      $posts->favoritescount = $favoritescount;
      $loggedInUser = Auth::user();
      $relatedUsers = $loggedInUser->getRelatedUsers();
      return Inertia::render("Single", [
        "posts" => $posts,
        "users" => $relatedUsers,
        "replies" => $replies,
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