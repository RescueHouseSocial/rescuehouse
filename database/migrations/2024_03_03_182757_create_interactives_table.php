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
        Schema::create('interactives', function (Blueprint $table) {
            $table->id();
            $table->uuid("interactiveId")->default(\Illuminate\Support\Str::uuid());
            $table->string("userId");
            $table->string("title")->nullable()->default("");
            $table->string("datetime8601");
            $table->string("duration");
            $table->string("visibility")->default("public");
            $table->string("type")->default("interactive");
            $table->string("status")->default("live");
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
        Schema::dropIfExists('interactives');
    }
};
