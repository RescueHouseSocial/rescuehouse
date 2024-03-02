<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Avatar;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Reply;
use App\Models\Favorite;

class FeedsController extends Controller
{

  public function show(Request $request): Response
  {

    $posts = Post::join("users", "posts.userId", "=", "users.userId")
      ->join("avatars", "users.userId", "=", "avatars.userId")
      ->leftJoin("galleries", "posts.postId", "=", "galleries.postId")
      ->leftJoin("favorites", function($join) {
        $join->on("posts.postId", "=", "favorites.postId")
          ->where("favorites.userId", "=", auth()->user()->userId)
          ->where("favorites.active", "=", 1);
      })
      ->where("posts.active", 1)
      ->where("users.active", 1)
      ->where("avatars.active", 1)
      ->select("posts.*", "users.name", "avatars.path")
      ->orderBy("posts.created_at", "desc")
      ->distinct()
      ->get();
    $posts->each(function ($post) {
      $favorites = Favorite::where("postId", $post->postId)
        ->where("userId", auth()->user()->userId)
        ->where("active", 1)
        ->get();
      $post->favorites = $favorites;
      $favoritescount = Favorite::where("postId", $post->postId)
        ->where("userId", auth()->user()->userId)
        ->where("active", 1)
        ->count();
      $post->favoritescount = $favoritescount;

      $repliescount = Reply::where("postId", $post->postId)
        ->where("active", 1)
        ->count();
      $post->repliescount = $repliescount;

      if (!empty($post->gallery)) {
        $galleries = Gallery::whereIn("galleryId", $post->gallery)->get();
        $post->galleries = $galleries;
      } else {
        $post->galleries = null;
      }
    });
    return Inertia::render("Feeds", [
      "posts" => $posts,
    ]);

  }

}