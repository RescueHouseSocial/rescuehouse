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
        Schema::create('rescues', function (Blueprint $table) {
            $table->id();
            $table->uuid("rescueId");
            $table->string("userId");
            $table->string("postId");
            $table->string("title")->nullable()->default("");
            $table->string("datetime8601");
            $table->string("visibility")->default("public");
            $table->string("type")->default("rescue");
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
        Schema::dropIfExists('rescues');
    }
};
