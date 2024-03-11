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

    $users = User::orderBy("email", "asc")->paginate(4);
    $tokens = Tokens::orderBy("name", "asc")
      ->get();
    return Inertia::render("Pirate/Home", [
      "tokens" => $tokens,
      "users" => $users,
    ]);

  }

  public function createtoken(Request $request) 
  {

    $file = $request->input("file");
    $token = Tokens::where("tokenId", $file)->first();
    $token->name = $request->input("name");
    $token->price = $request->input("price");
    $token->save();

    return redirect()->route("pirate")->with("success", "Pirate updated successfully.");

  }

}