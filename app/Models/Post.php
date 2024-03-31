<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

  use HasFactory;

  protected $fillable = ["postId", "userId", "title", "body", "datetime8601", "visibility", "type", "status", "gallery"];

  protected $casts = ["gallery" => "array"];

  public static function getPostsByType($type)
  {

    return self::join("users", "posts.userId", "=", "users.userId")
      ->leftJoin("avatars", "users.userId", "=", "avatars.userId")
      ->leftJoin("galleries", "posts.postId", "=", "galleries.postId")
      ->leftJoin("favorites", function($join) {
      $join->on("posts.postId", "=", "favorites.postId")
        ->where("favorites.userId", "=", auth()->user()->userId)
        ->where("favorites.active", "=", 1);
      })
      ->where("posts.type", $type)
      ->where("posts.active", 1)
      ->where("users.active", 1)
      ->where("avatars.active", 1)
      ->select("posts.*", "users.name", "avatars.path")
      ->orderBy("posts.created_at", "desc")
      ->distinct()
      ->get();

  }

  public function loadPostMetadata()
  {

    $this->loadFavorites();
    $this->loadFavoritesCount();
    $this->loadRepliesCount();
    $this->loadGalleries();

  }

  protected function loadFavorites()
  {

    $this->favorites = Favorite::where("postId", $this->postId)
    ->where("userId", auth()->user()->userId)
    ->where("active", 1)
    ->get();

  }

  protected function loadFavoritesCount()
  {

    $this->favoritescount = Favorite::where("postId", $this->postId)
    ->where("userId", auth()->user()->userId)
    ->where("active", 1)
    ->count();

  }

  protected function loadRepliesCount()
  {

    $this->repliescount = Reply::where("postId", $this->postId)
    ->where("active", 1)
    ->count();

  }

  protected function loadGalleries()
  {

    if (!empty($this->gallery)) {
      $this->galleries = Gallery::whereIn("galleryId", $this->gallery)->get();
    } else {
      $this->galleries = null;
    }

  }
  
}
