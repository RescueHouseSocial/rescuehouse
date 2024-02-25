<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Avatar;

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
    } else {
      $userId = Auth::user()->userId;
      $user = User::where("userId", $userId)
        ->where("active", 1)
        ->first();
      $avatar = Avatar::where("userId", $userId)
        ->where("active", 1)
        ->first();
    }
    return Inertia::render("Account", [
      "users" => $user,
      "avatar" => $avatar,
    ]);

  }

}