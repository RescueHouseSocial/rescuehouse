<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    "userId",
    "name",
    "email",
    "location",
    "biography",
    "password",
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    "password",
    "remember_token",
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    "email_verified_at" => "datetime",
    "password" => "hashed",
  ];

  /**
   * Get users related to the logged-in user.
   *
   * @return \Illuminate\Database\Eloquent\Collection
   */
  public function getRelatedUsers()
  {

    // Get the ID of the currently authenticated user
    $loggedInUserId = Auth::id();

    // Query users related to the logged-in user, you can customize this query as per your requirements
    return $this->where("id", $loggedInUserId)
    ->where("active", 1)
    ->get();

  }
  
}
