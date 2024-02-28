<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
  use HasFactory;

  protected $fillable = [
    "postId", 
    "userId",
    "title", 
    "body", 
    "datetime8601",
    "visibility",
    "type",
    "status",
    ];
}
