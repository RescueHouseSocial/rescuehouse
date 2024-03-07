<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

use App\Models\Tokens;
use App\Models\Checkout;

class CheckoutController extends Controller
{

  public function show(Request $request, $checkoutId = null): Response
  {

    $checkouts = Checkout::where("active", 1)
      ->where("status", "open")
      ->where("checkoutId", $checkoutId)
      ->get();
    $tokens = [];
    foreach ($checkouts as $checkout) {
      $processedTokens = json_decode($checkout->tokenId, true);
      foreach ($processedTokens as $token) {
        $checkoutForToken = Tokens::where("active", 1)
          ->where("tokenId", $token)
          ->get();
        if ($checkoutForToken) {
          $tokens[$token] = $checkoutForToken;
        }
      }
    }
    $totalPrice = 0;
    foreach ($tokens as $token => $checkoutItems) {
      foreach ($checkoutItems as $item) {
        $totalPrice += (int) $item["price"];
      }
    }
    return Inertia::render("Checkout", [
      "checkouts" => $checkouts,
      "tokens" => $tokens,
      "totalPrice" => $totalPrice,
    ]);

  }

}
