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

    Schema::create("replies", function (Blueprint $table) {
      $table->id();
      $table->uuid("replyId")->default(\Illuminate\Support\Str::uuid());
      $table->uuid("postId");
      $table->string("userId");
      $table->string("title")->nullable()->default("");
      $table->text("body");
      $table->string("datetime8601");
      $table->string("visibility")->default("public");
      $table->string("type")->default("text");
      $table->string("status")->default("published");
      $table->boolean("ban")->default(false);
      $table->boolean("active")->default(true);
      $table->timestamps();
    });

  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {

    Schema::dropIfExists("replies");
  }

};
