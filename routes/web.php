<?php

use App\Http\Controllers\HomeController;

use App\Http\Controllers\FeedsController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\GalleryController;

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

Route::get('/', [HomeController::class, 'show'])->name('home');

Route::get('/about', function () {
  return Inertia::render('About');
});

Route::middleware("auth")->group(function () {

  Route::get("/feeds", [FeedsController::class, "show"])->name("feeds");

  Route::get("/account/{userId?}", [AccountController::class, "show"])->name("account");
  Route::post("/account", [AccountController::class, "follow"])->name("account.follow");

  Route::get("/post/{postId?}", [PostController::class, "show"])->name("post");
  Route::put("/post", [PostController::class, "store"])->name("post.store");

  Route::put("/reply", [ReplyController::class, "store"])->name("reply.store");

  Route::post("/gallery", [GalleryController::class, "store"])->name("gallery.store");

  Route::get("/market", [MarketController::class, "show"])->name("market");
  Route::get("/calendar", [CalendarController::class, "show"])->name("calendar");

  Route::get("/settings", [SettingsController::class, "show"])->name("settings");
  Route::patch("/settings", [SettingsController::class, "update"])->name("settings.update");
  Route::post("/settings", [SettingsController::class, "updateavatar"])->name("settings.updateavatar");

});

require __DIR__.'/auth.php';
