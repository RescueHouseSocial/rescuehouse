<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ErrorController extends Controller
{

  public function show(Request $request)
  {

    return Inertia::render("Error");

  }

}