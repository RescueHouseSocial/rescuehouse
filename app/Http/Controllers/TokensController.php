<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

use App\Models\Tokens;

class TokensController extends Controller
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

    $uuid = Str::uuid();
    $userId = Auth::user()->userId;
    $selectedFiles = $request->file("selectedFiles");
    $resizedFiles = [];
    foreach ($selectedFiles as $file) {
      $resizedImage = Image::make($file)
        ->fit(400, 400)
        ->encode();
      $resizedPath = public_path("storage/tokens/medium");
      $resizedFileName = $uuid . "." . $file->getClientOriginalExtension();
      $resizedImage->save($resizedPath . "/" . $resizedFileName);
      $token = Tokens::create([
        "tokenId" => $uuid,
        "userId" => $userId,
        "name" => "Token",
        "path" => $resizedFileName,
        "price" => 0.00,
      ]);
    }

    $id = $token->id;
    $single = Tokens::find($id);
    $tokenId = $single->tokenId;

    return response()->json(["tokenId" => $tokenId, "message" => "Token item created successfully."]);
    
  }

  /**
   * Display the specified resource.
   */
  public function show(Tokens $tokens)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Tokens $tokens)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Tokens $tokens)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Tokens $tokens)
  {
    //
  }

}
