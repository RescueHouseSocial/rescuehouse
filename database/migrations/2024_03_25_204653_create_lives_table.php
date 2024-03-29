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
        Schema::create('lives', function (Blueprint $table) {
            $table->id();
            $table->uuid("liveId");
            $table->string("ownerId");
            $table->string("moderatorId")->nullable();
            $table->text("attendees")->nullable();
            $table->text("bans")->nullable();
            $table->string("visibility")->default("public");
            $table->string("style")->default("many");
            $table->boolean("active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lives');
    }
};
