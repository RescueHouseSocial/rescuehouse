<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

use App\Models\Favorite;

class FavoriteController extends Controller
{

  public function store(Request $request)
  {
    
    $action = $request->input("favoried");
    $userId = Auth::user()->userId;
    $postId = $request->input("postId");
    if ($action === false) {
      $favorite = new Favorite();
      $favorite->postId = $postId;
      $favorite->userId = $userId;
      $favorite->save();
    } else {
      Favorite::where("postId", $postId)
        ->where("userId", $userId)
        ->update(["active" => false]);
    }

  }

}