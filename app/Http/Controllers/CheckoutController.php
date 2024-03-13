<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;
use Stripe\Math\Math;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Charge;

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

    $platformFee = config("helper.platform");
    $stripePercentageFee = config("helper.percentage");
    $stripeFee = config("helper.fee");

    $stripeFeeInCents = $stripeFee * 100;
    $stripePercentageInCents = round($totalPrice * $stripePercentageFee);
    $totalStripeFeesInCents = $stripeFeeInCents + $stripePercentageInCents;
    $totalTransactionFeesInCents = $totalStripeFeesInCents + $platformFee;
    $totalPriceAndFeesInCents = $totalPrice + $totalTransactionFeesInCents;

    return Inertia::render("Checkout", [
      "checkouts" => $checkouts,
      "tokens" => $tokens,
      "totalPrice" => $totalPrice,
      "fees" => $totalTransactionFeesInCents,
      "totalAndFees" => $totalPriceAndFeesInCents,
    ]);

  }

  public function createPayment(Request $request)
  {

    $checkouts = Checkout::where("active", 1)
    ->where("status", "open")
    ->where("checkoutId", $request->checkoutId)
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

    $platformFee = config("helper.platform");
    $stripePercentageFee = config("helper.percentage");
    $stripeFee = config("helper.fee");

    $stripeFeeInCents = $stripeFee * 100;
    $stripePercentageInCents = round($totalPrice * $stripePercentageFee);
    $totalStripeFeesInCents = $stripeFeeInCents + $stripePercentageInCents;
    $totalTransactionFeesInCents = $totalStripeFeesInCents + $platformFee;
    $totalPriceAndFeesInCents = $totalPrice + $totalTransactionFeesInCents;

    $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
    try {
      $paymentIntent = $stripe->paymentIntents->create([
        "amount" => $totalPriceAndFeesInCents,
        "currency" => "usd",
        "automatic_payment_methods" => [
          "enabled" => true,
        ],
      ]);
      $output = [
        "clientSecret" => $paymentIntent->client_secret,
      ];
      return response()->json(["output" => $output, "message" => "Create payment successful"]);
    } catch (Error $e) {
      return response()->json(["message" => "Create payment failed"]);
    }
  }

  public function processPayment(Request $request)
  {

    Checkout::where("checkoutId", $request->checkoutId)
      ->where("active", 1)
      ->update(["active" => 0, "status" => "closed"]);

  }

}
