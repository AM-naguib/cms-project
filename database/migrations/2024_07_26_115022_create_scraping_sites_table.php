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
        Schema::create('scraping_sites', function (Blueprint $table) {
            $table->id();
            $table->string("site_name", 191)->unique(); 
            $table->string("site_url", 191)->unique();  
            $table->text("title_selector")->nullable();
            $table->text("genre_selector")->nullable();
            $table->text("keyword_selector")->nullable();
            $table->text("description_selector")->nullable();
            $table->text("watch_urls_selector")->nullable();
            $table->text("download_urls_selector")->nullable();
            $table->text("category_selector")->nullable();
            $table->text("quality_selector")->nullable();
            $table->text("year_selector")->nullable();
            $table->text("episode_number_selector")->nullable();
            $table->text("duration_selector")->nullable();
            $table->text("image_url_selector")->nullable();
            $table->text("season_selector")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scraping_sites');
    }
};
