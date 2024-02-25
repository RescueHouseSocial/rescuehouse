<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('avatars', function (Blueprint $table) {
      $table->id();
      $table->uuid("avatarId")->default(\Illuminate\Support\Facades\DB::raw("UUID()"));
      $table->string("userId");
      $table->string("path");
      $table->boolean("active")->default(true);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists("avatars");
  }
};
