<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use App\Models\User;
use App\Models\Avatar;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Follow;
use App\Models\Favorite;
use App\Models\Reply;
use App\Models\Bank;
use App\Models\Tokens;

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
      $myposts = Post::join("users", "posts.userId", "=", "users.userId")
        ->leftJoin("avatars", "users.userId", "=", "avatars.userId")
        ->leftJoin("galleries", "posts.postId", "=", "galleries.postId")
        ->leftJoin("favorites", function($join) use ($userId) {
          $join->on("posts.postId", "=", "favorites.postId")
            ->where("favorites.userId", "=", $userId)
            ->where("favorites.active", "=", 1);
        })
        ->where("posts.userId", $userId)
        ->where("posts.active", 1)
        ->where("users.active", 1)
        ->select("posts.*", "users.name", "avatars.path")
        ->orderBy("posts.created_at", "desc")
        ->distinct()
        ->get();
      $myposts->each(function ($post) use ($userId) {
        $favorites = Favorite::where("postId", $post->postId)
          ->where("userId", $userId)
          ->where("active", 1)
          ->get();
        $post->favorites = $favorites;
        if (!empty($post->gallery)) {
          $galleries = Gallery::whereIn("galleryId", $post->gallery)->get();
          $post->galleries = $galleries;
        } else {
          $post->galleries = null;
        }
      });
      $myreplies = Reply::join("users", "replies.userId", "=", "users.userId")
        ->leftJoin("avatars", "users.userId", "=", "avatars.userId")
        ->where("replies.userId", $userId)
        ->where("replies.active", 1)
        ->where("users.active", 1)
        ->select("replies.*", "users.name", "avatars.path")
        ->orderBy("replies.created_at", "desc")
        ->get();
      $banks = Bank::where("userId", $userId)
        ->where("active", 1)
        ->get();
      $mybank = [];
      foreach ($banks as $bank) {
        $processedTokens = json_decode($bank->tokenId, true);
        foreach ($processedTokens as $token) {
          $bankForToken = Tokens::where("active", 1)
            ->where("tokenId", $token)
            ->get();
          if ($bankForToken) {
            $mybank[$token] = $bankForToken;
          }
        }
      }
      $mygalleries = Gallery::where("userId", $userId)
        ->where("active", 1)
        ->get();
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
      $myposts = Post::join("users", "posts.userId", "=", "users.userId")
        ->leftJoin("avatars", "users.userId", "=", "avatars.userId")
        ->leftJoin("galleries", "posts.postId", "=", "galleries.postId")
        ->leftJoin("favorites", function($join) {
        $join->on("posts.postId", "=", "favorites.postId")
            ->where("favorites.userId", "=", auth()->user()->userId)
            ->where("favorites.active", "=", 1);
        })
        ->where("posts.userId", auth()->user()->userId)
        ->where("posts.active", 1)
        ->where("avatars.active", 1)
        ->where("users.active", 1)
        ->select("posts.*", "users.name", "avatars.path")
        ->orderBy("posts.created_at", "desc")
        ->distinct()
        ->get();
      $myposts->each(function ($post) {
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
      $myreplies = Reply::join("users", "replies.userId", "=", "users.userId")
        ->leftJoin("avatars", "users.userId", "=", "avatars.userId")
        ->where("replies.userId", auth()->user()->userId)
        ->where("replies.active", 1)
        ->where("users.active", 1)
        ->where("avatars.active", 1)
        ->select("replies.*", "users.name", "avatars.path")
        ->orderBy("replies.created_at", "desc")
        ->get();
      $banks = Bank::where("userId", auth()->user()->userId)
        ->where("active", 1)
        ->get();
      $mybank = [];
      foreach ($banks as $bank) {
        $processedTokens = json_decode($bank->tokenId, true);
        foreach ($processedTokens as $token) {
          $bankForToken = Tokens::where("active", 1)
            ->where("tokenId", $token)
            ->get();
          if ($bankForToken) {
            $mybank[$token] = $bankForToken;
          }
        }
      }
      $mygalleries = Gallery::where("userId", auth()->user()->userId)
        ->where("active", 1)
        ->get();
    }
    return Inertia::render("Account", [
      "users" => $user,
      "avatar" => $avatar,
      "follow" => $follow,
      "followerscount" => $followerscount,
      "followingcount" => $followingcount,
      "postcount" => $postcount,
      "myposts" => $myposts,
      "myreplies" => $myreplies,
      "mygalleries" => $mygalleries,
      "mybank" => $mybank,
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