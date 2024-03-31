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
use App\Models\Bank;
use App\Models\Tokens;

class FeedsController extends Controller
{

  public function showsocial(Request $request)
  {

    $userId = Auth::user()->userId;
    $type = "social";
    $posts = Post::getPostsByType($type);

    $posts->each(function ($post) {
      $post->loadPostMetadata();
    });

    $banks = Bank::where("active", 1)
      ->where("userId", $userId)
      ->get();
    $mybank = [];
    foreach($banks as $bank) {
      $processedTokens = json_decode($bank->tokenId, true);
      foreach ($processedTokens as $token) {
        $bankForToken = Tokens::where("active", 1)
          ->where("tokenId", $token)
          ->get();
        $mybank[$token] = $bankForToken;
      }
    }

    return response()->json(["posts" => $posts, "mybank" => $mybank, "message" => "Feeds Social successfully."]);

  }

  public function showrescue(Request $request)
  {

    $userId = Auth::user()->userId;
    $type = "rescue";
    $posts = Post::getPostsByType($type);

    $posts->each(function ($post) {
      $post->loadPostMetadata();
    });

    $banks = Bank::where("active", 1)
      ->where("userId", $userId)
      ->get();
    $mybank = [];
    foreach($banks as $bank) {
      $processedTokens = json_decode($bank->tokenId, true);
      foreach ($processedTokens as $token) {
        $bankForToken = Tokens::where("active", 1)
          ->where("tokenId", $token)
          ->get();
        $mybank[$token] = $bankForToken;
      }
    }

    return response()->json(["posts" => $posts, "mybank" => $mybank, "message" => "Feeds Rescue successfully."]);

  }

  public function showinteractive(Request $request)
  {

    $userId = Auth::user()->userId;
    $type = "interactive";
    $posts = Post::getPostsByType($type);

    $posts->each(function ($post) {
      $post->loadPostMetadata();
    });

    $banks = Bank::where("active", 1)
      ->where("userId", $userId)
      ->get();
    $mybank = [];
    foreach($banks as $bank) {
      $processedTokens = json_decode($bank->tokenId, true);
      foreach ($processedTokens as $token) {
        $bankForToken = Tokens::where("active", 1)
          ->where("tokenId", $token)
          ->get();
        $mybank[$token] = $bankForToken;
      }
    }

    return response()->json(["posts" => $posts, "mybank" => $mybank, "message" => "Feeds Interactive successfully."]);

  }

  public function show(Request $request): Response
  {

    return Inertia::render("Feeds");

  }

}