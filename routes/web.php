<?php

use App\Http\Controllers\HomeController;

use App\Http\Controllers\FeedsController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\InteractiveController;
use App\Http\Controllers\RescueController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\TokensController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\PirateController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::domain('admin.site.com')->group(function () {
//   Route::get('/', 'AdminController@index');
// });

Route::get("/", [HomeController::class, "show"])->name("home");

Route::get("/about", function () {
  return Inertia::render("About");
});

Route::middleware("auth")->group(function () {

  Route::get("/feeds", [FeedsController::class, "show"])->name("feeds");

  Route::get("/account/{userId?}", [AccountController::class, "show"])->name("account");
  Route::post("/account", [AccountController::class, "follow"])->name("account.follow");

  Route::get("/post/{postId?}", [PostController::class, "show"])->name("post");
  Route::put("/post", [PostController::class, "store"])->name("post.store");

  Route::put("/interactive", [InteractiveController::class, "store"])->name("interactive.store");
  Route::put("/rescue", [RescueController::class, "store"])->name("rescue.store");

  Route::put("/reply", [ReplyController::class, "store"])->name("reply.store");

  Route::post("/favorite", [FavoriteController::class, "store"])->name("favorite.store");

  Route::post("/gallery", [GalleryController::class, "store"])->name("gallery.store");

  Route::post("/tokens", [TokensController::class, "store"])->name("token.store");

  Route::get("/market/{any?}", [MarketController::class, "show"])->name("market");
  Route::post("/marketstore", [MarketController::class, "store"])->name("market.store");
  Route::post("/marketcart", [MarketController::class, "cart"])->name("market.cart");

  Route::get("/calendar", [CalendarController::class, "show"])->name("calendar");

  Route::get("/settings", [SettingsController::class, "show"])->name("settings");
  Route::post("/settingsupdate", [SettingsController::class, "update"])->name("settings.update");
  Route::post("/settingsupdateavatar", [SettingsController::class, "updateavatar"])->name("settings.updateavatar");

  Route::get("/checkout/{checkoutId}", [CheckoutController::class, "show"])->name("checkout");
  Route::post("/checkoutcreatePayment", [CheckoutController::class, "createPayment"])->name("checkout.createPayment");
  Route::post("/checkoutprocessPayment", [CheckoutController::class, "processPayment"])->name("checkout.processPayment");

  // Route::get('/payment/success', function () {
  // return 'Payment Successful!';
  // })->name('payment.success');
  // Route::get('/payment/failure', function () {
  // return 'Payment Failed!';})->name('payment.failure');


  Route::get("/pirate", [PirateController::class, "show"])->name("pirate");
  Route::post("/piratecreatetoken", [PirateController::class, "createtoken"])->name("pirate.createtoken");

});

require __DIR__.'/auth.php';
