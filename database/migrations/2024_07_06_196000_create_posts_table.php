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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('slug')->unique();
            $table->text("description")->nullable();
            $table->text("watch_urls")->nullable();
            $table->text("download_urls")->nullable();
            $table->foreignId("category_id")->constrained()->onDelete("cascade");
            $table->foreignId("main_name_id")->constrained()->onDelete("cascade");
            $table->foreignId("quality_id")->constrained()->onDelete("cascade");
            $table->foreignId("year_id")->constrained()->onDelete("cascade");
            $table->integer("episode_number")->nullable();
            $table->integer("duration")->nullable();
            $table->integer("status")->nullable();
            $table->text("image_url")->nullable();
            $table->integer("season")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
