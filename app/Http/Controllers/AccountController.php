<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Post;
use App\Models\Avatar;
use App\Models\Follow;

class AccountController extends Controller
{

  public function show(Request $request, $userId = null): Response
  {

    if ($userId) {
      $user = User::where("userId", $userId)
        ->where("active", 1)
        ->first();
      $avatar = Avatar::where("userId", $userId)
        ->where("active", 1)
        ->first();
      $follow = Follow::where("followee_id", $userId)
        ->where("follower_id", Auth::user()->userId)
        ->where("active", true)
        ->exists();
      $followerscount = Follow::where("followee_id", $userId)
        ->where("active", true)
        ->count();
      $followingcount = Follow::where("follower_id", $userId)
        ->where("active", true)
        ->count();
      $postcount = Post::where("userId", $userId)
        ->where("active", true)
        ->count();
    } else {
      $userId = Auth::user()->userId;
      $user = User::where("userId", $userId)
        ->where("active", 1)
        ->first();
      $avatar = Avatar::where("userId", $userId)
        ->where("active", 1)
        ->first();
      $follow = null;
      $followerscount = Follow::where("followee_id", $userId)
        ->where("active", true)
        ->count();
      $followingcount = Follow::where("follower_id", $userId)
        ->where("active", true)
        ->count();
      $postcount = Post::where("userId", $userId)
        ->where("active", true)
        ->count();
    }
    return Inertia::render("Account", [
      "users" => $user,
      "avatar" => $avatar,
      "follow" => $follow,
      "followerscount" => $followerscount,
      "followingcount" => $followingcount,
      "postcount" => $postcount,
    ]);

  }

  public function follow(Request $request)
  {

    $action = $request->input("following");
    $refererUrl = $request->header("referer");
    $followee_id = substr($refererUrl, strpos($refererUrl, "/account/") + strlen("/account/"));
    $follower_id = Auth::user()->userId;
    if ($action === true) {
      $follow = new Follow();
      $follow->followee_id = $followee_id; // The Account to be followed
      $follow->follower_id = $follower_id; // the logged in person following
      $follow->save();
    } else {
      Follow::where("followee_id", $followee_id)
      ->where("follower_id", $follower_id)
      ->update(["active" => false]);
    }

    return response()->json(["things" => $follower_id, "message" => "Followed successfully"]);

  }

}