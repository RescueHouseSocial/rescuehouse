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

class ReplyController extends Controller
{

  public function store(Request $request)
  {

    $userId = Auth::user()->userId;
    $request->validate([
      "body" => "required",
    ]);
    $post = Reply::create([
      "postId" => $request->postId,
      "userId" => $userId,
      "body" => $request->body,
      "datetime8601" => $request->datetime8601,
    ]);
    return redirect("/post/" . $request->postId);
    
  }

}