<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Post;

class FeedsController extends Controller
{

  public function show(Request $request, Post $postModel): Response
  {

    $posts = $postModel->getAllPostsOrderedByCreatedAt();
    return Inertia::render("Feeds", ['posts' => $posts]);
    
  }

}