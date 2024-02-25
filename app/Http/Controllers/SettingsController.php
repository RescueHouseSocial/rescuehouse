<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Avatar;

class SettingsController extends Controller
{

  public function show(Request $request): Response
  {

    $loggedInUser = Auth::user();
    $userId = Auth::user()->userId;
    $avatar = Avatar::where("userId", $userId)
      ->where("active", 1)
      ->first();
    $relatedUsers = $loggedInUser->getRelatedUsers();
    return Inertia::render("Settings", [
      "users" => $relatedUsers,
      "avatar" => $avatar,
    ]);

    
    
  }

  public function updateavatar(Request $request) 
  {

    $uuid = Str::uuid();
    $userId = Auth::user()->userId;
    $selectedFiles = $request->file("selectedFiles");
    $resizedFiles = [];
    foreach ($selectedFiles as $file) {
      $resizedImage = Image::make($file)
        ->fit(400, 400)
        ->encode();
      $resizedPath = public_path("storage/avatars/medium");
      $resizedFileName = $uuid . "." . $file->getClientOriginalExtension();
      $resizedImage->save($resizedPath . "/" . $resizedFileName);
      Avatar::where('userId', $userId)
        ->update(['active' => 0]);
      Avatar::create([
        "userId" => $userId,
        "path" => $resizedFileName,
      ]);
    }
    return response()->json(["resized_files" => $resizedFiles, "message" => "Files resized successfully"]);

  }

  public function update(Request $request)
  {

    $request->validate([
      "name" => "required",
    ]);
    auth()->user()->update(["name" => $request->input("name")]);
    return redirect()->route("settings")->with("success", "Settings updated successfully.");

  }

}
