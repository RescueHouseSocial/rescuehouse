<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

// use App\Models\User;
// use App\Models\Avatar;
// use App\Models\Post;
// use App\Models\Gallery;
// use App\Models\Reply;
// use App\Models\Favorite;

class SearchController extends Controller
{

  public function show(Request $request): Response
  {

    return Inertia::render("Search");

  }

}
