<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

use App\Models\Interactive;

class InteractiveController extends Controller
{

  public function store(Request $request)
  {

    // dd($request);

    $userId = Auth::user()->userId;
    $post = Interactive::create([
      "postId" => $request->postId,
      "userId" => $userId,
      "datetime8601" => $request->datetime,
      "duration" => $request->duration,
    ]);
    return redirect("/post/" . $request->postId);
    
  }

}