<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

  use HasFactory;

  protected $fillable = ["galleryId", "userId", "postId", "path"];

  public function galleries()
  {

    return $this->hasMany(Gallery::class, "postId");

  }

}
