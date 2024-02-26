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

class PostController extends Controller
{

  public function show(Request $request, $postId = null): Response
  {

    if ($postId) {
      $paths = [];
      $post = Post::join('users', 'posts.userId', '=', 'users.userId')
        ->join('avatars', 'users.userId', '=', 'avatars.userId')
        ->where('posts.postId', $postId)
        ->select('posts.*', 'users.name', 'avatars.path')
        ->first();
      foreach($post->gallery as $galleryId) {
        $image = Gallery::find($galleryId);
        $paths[] = $image->path;
      }
      return Inertia::render("Single", [
        "post" => $post,
        "gallery" => $paths,
      ]);
    } else {
      $loggedInUser = Auth::user();
      $relatedUsers = $loggedInUser->getRelatedUsers();
      return Inertia::render("Post", [
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
      "userId" => $userId,
      "body" => $request->body,
      "datetime8601" => $request->datetime8601,
      "gallery" => $request->gallery,
    ]);
    $id = $post->id;
    $single = Post::find($id);
    $postId = $single->postId;
    return redirect("/post/" . $postId);
    
  }

}