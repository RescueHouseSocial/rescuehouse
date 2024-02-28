<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\User;
use App\Models\Avatar;
use App\Models\Post;
use App\Models\Gallery;

class FeedsController extends Controller
{

  public function show(Request $request): Response
  {

    $posts = Post::join("users", "posts.userId", "=", "users.userId")
      ->join("avatars", "users.userId", "=", "avatars.userId")
      ->leftJoin("galleries", "posts.postId", "=", "galleries.postId")
      ->where("posts.active", 1)
      ->where("users.active", 1)
      ->where("avatars.active", 1)
      ->select("posts.*", "users.name", "avatars.path")
      ->orderBy("posts.created_at", "desc")
      ->distinct()
      ->get();
      $posts->each(function ($post) {
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