<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

  use HasFactory;

  protected $fillable = ["postId", "userId", "title", "body", "datetime8601", "visibility", "type", "status", "gallery"];

  protected $casts = [
    "gallery" => "array",
  ];

  public function getAllPostsOrderedByCreatedAt()
  {

    return $this->join("users", "posts.userId", "=", "users.userId")
    ->join("avatars", function ($join) {
        $join->on("users.userId", "=", "avatars.userId")
            ->where("avatars.active", "=", 1);
    })
    ->where("posts.active", "=", 1)
    ->where("users.active", "=", 1)
    ->orderBy("posts.created_at", "desc")
    ->select("posts.*", "users.name", "avatars.path")
    ->get();

  }
  
}
