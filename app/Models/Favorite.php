<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
  use HasFactory;

  protected $fillable = ["userId", "postId"];

  public static function loadFavoriteMetadata($postId)
  {

    return self::where("postId", $postId)
    ->where("userId", auth()->user()->userId)
    ->where("active", 1)
    ->get();
    
  }

}
