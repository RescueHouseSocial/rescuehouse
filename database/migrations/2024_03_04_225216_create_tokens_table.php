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
        Schema::create("tokens", function (Blueprint $table) {
            $table->id();
            $table->uuid("tokenId")->default(\Illuminate\Support\Str::uuid());
            $table->string("userId");
            $table->string("name");
            $table->string("path");
            $table->decimal("price", 10, 2);
            $table->string("visibility")->default("public");
            $table->string("type")->default("general");
            $table->string("status")->default("published");
            $table->boolean("active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("tokens");
    }
};
