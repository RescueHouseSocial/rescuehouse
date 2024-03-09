<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

use App\Models\Gallery;

class GalleryController extends Controller
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
      $resizedPath = public_path("storage/gallery/medium");
      $resizedFileName = $uuid . "." . $file->getClientOriginalExtension();
      $resizedImage->save($resizedPath . "/" . $resizedFileName);
      $gallery = Gallery::create([
        "galleryId" => $uuid,
        "userId" => $userId,
        "postId" => $request->postId,
        "path" => $resizedFileName,
      ]);
    }

    $id = $gallery->id;
    $single = Gallery::find($id);
    $galleryId = $single->galleryId;

    return response()->json(["galleryId" => $galleryId, "message" => "Gallery item created successfully."]);
    
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

}
