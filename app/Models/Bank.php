<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{

  use HasFactory;

  protected $fillable = ["bankId", "userId", "tokenId", "funded"];

  // public static function getUserBank()
  // {

  //   return self::where("userId", auth()->user()->userId)
  //   ->where("active", 1)
  //   ->get();
    
  // }

}
