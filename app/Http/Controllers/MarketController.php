<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

use App\Models\Tokens;
use App\Models\Checkout;

class MarketController extends Controller
{

  public function show(Request $request): Response
  {

    $tokens = Tokens::where("active", 1)
      ->where("visibility", "public")
      ->where("status", "published")
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

    $uuid = Uuid::uuid4()->toString();
    $userId = Auth::user()->userId;
    $checkoutTokens = $request->has("checkoutTokens") ? $request->checkoutTokens : [];
    $processedTokens = [];
    foreach ($checkoutTokens as $tokens) {
      $processedTokens[] = $tokens;
    }
    $serializedTokens = json_encode($processedTokens);
    $checkout = new Checkout();
    $checkout->checkoutId = $uuid;
    $checkout->userId = $userId;
    $checkout->tokenId = $serializedTokens;
    $checkout->save();
    return response()->json(["checkoutId" => $uuid, "message" => "Cart has been updated successfully."]);

  }

}