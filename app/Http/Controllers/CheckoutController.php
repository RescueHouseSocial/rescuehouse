<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

  public function show(Request $request): Response
  {

    return Inertia::render("Checkout");
    
  }

}
