<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Avatar;
use App\Models\Post;

class PostController extends Controller
{

  public function show(Request $request, $postId = null): Response
  {

    if ($postId) {
      $post = Post::join('users', 'posts.userId', '=', 'users.userId')
        ->join('avatars', 'users.userId', '=', 'avatars.userId')
        ->where('posts.postId', $postId)
        ->select('posts.*', 'users.name', 'avatars.path')
        ->first();
      return Inertia::render("Single", [
        "post" => $post,
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

    $request->validate([
      "body" => "required",
    ]);
    $post = Post::create($request->all());
    $id = $post->id;
    $single = Post::find($id);
    $postId = $single->postId;
    return redirect("/post/" . $postId);
    
  }

}