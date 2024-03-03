<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interactive extends Model
{

  use HasFactory;

  protected $fillable = [
    "postId", 
    "userId",
    "datetime8601",
    "duration",
  ];

}
