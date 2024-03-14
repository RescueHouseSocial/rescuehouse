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
use App\Models\Favorite;
use App\Models\Tokens;

class PirateController extends Controller
{

  public function show(Request $request): Response
  {

    $users = User::orderBy("email", "desc")->paginate($perPage = 4, $columns = ["*"], $pageName = "users");
    $socialposts = Post::orderBy("id", "desc")
      ->where("type", "social")
      ->paginate($perPage = 4, $columns = ["*"], $pageName = "social");
    $rescueposts = Post::orderBy("id", "desc")
      ->where("type", "rescue")
      ->paginate($perPage = 4, $columns = ["*"], $pageName = "rescue");
    $interactiveposts = Post::orderBy("id", "desc")
      ->where("type", "interactive")
      ->paginate($perPage = 4, $columns = ["*"], $pageName = "interactive");
    $tokens = Tokens::where("active", 1)
      ->where("status", "published")
      ->orderBy("name", "asc")
      ->get();
    return Inertia::render("Pirate/Home", [
      "tokens" => $tokens,
      "users" => $users,
      "socialposts" => $socialposts,
      "rescueposts" => $rescueposts,
      "interactiveposts" => $interactiveposts,
    ]);

  }

  public function createtoken(Request $request) 
  {

    $price = $request->input("price");
    $priceInCents = $price * 100;
    $file = $request->input("file");
    $token = Tokens::where("tokenId", $file)->first();
    $token->name = $request->input("name");
    $token->price = $priceInCents;
    $token->save();

    return redirect()->route("pirate")->with("success", "Pirate updated successfully.");

  }

}