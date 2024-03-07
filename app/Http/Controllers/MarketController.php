<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Tokens;

class MarketController extends Controller
{

  public function show(Request $request): Response
  {

    $tokens = Tokens::where("active", 1)
      ->where("visibility", "public")
      ->orderBy("name", "asc")
      ->get();
    return Inertia::render("Market", [
      "tokens" => $tokens,
    ]);
    
  }

  public function cart(Request $request)
  {

    $checkoutTokens = $request->has("checkoutTokens") ? $request->checkoutTokens : [];
    $tokenDetails = [];
    foreach ($checkoutTokens as $token) {
      $tokenData = Tokens::where("tokenId", $token)->first();
      if ($tokenData) {
        $tokenDetails[] = $tokenData;
      }
    }

    return response()->json(["tokenDetails" => $tokenDetails, "message" => "Cart has been updated successfully."]);

  }

  public function store(Request $request)
  {

    dd($request);

  }

}