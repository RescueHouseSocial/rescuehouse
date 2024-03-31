<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\Bank;

class BankController extends Controller
{

  /**
   * Display a listing of the resource.
   */
  public function index()
  {

    //

  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {

    //

  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {

    dd("Bank Store");

  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {

    //

  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {

    //

  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {

    //

  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {

    //

  }

  /**
   * Process token transfer from user to user.
   */
  public function processTransfer(Request $request)
  {

    $uuid = Uuid::uuid4()->toString();
    $userId = Auth::user()->userId;
    $posts = Post::where("active", 1)
      ->where("postId", $request->postId)
      ->get();
    $transferUserId = $posts[0]->userId;
    $bank = Bank::where("active", 1)
      ->where("userId", $transferUserId)
      ->get();
    if (!$bank->isEmpty()) {
      $currentTokensDecode = json_decode($bank[0]->tokenId, true);
      $mergedTokens = array_merge($request->tokens, $currentTokensDecode);
      $mergedTokensJson = json_encode($mergedTokens);
      Bank::where("userId", $transferUserId)
        ->update(["active" => 0]);
      Bank::create([
        "bankId" => $uuid,
        "userId" => $transferUserId,
        "tokenId" => $mergedTokensJson,
      ]);
    } else {
      $tokenId = json_encode($request->tokens);
      Bank::create([
        "bankId" => $uuid,
        "userId" => $transferUserId,
        "tokenId" => $tokenId,
      ]);
    }
    $bank = Bank::where("active", 1)
      ->where("userId", $userId)
      ->get();
    $userTokensDecode = json_decode($bank[0]->tokenId, true);
    $subtractTokens = $request->tokens;
    $remainingTokens = array_diff($userTokensDecode, $subtractTokens);
    $mergedTokensJson = json_encode($remainingTokens);
    Bank::where("userId", $userId)
      ->update(["tokenId" => $mergedTokensJson]);
    return response()->json(["success" => "Create transfer successful"]);

  }

}
