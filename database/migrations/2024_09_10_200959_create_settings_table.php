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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("site_title")->nullable();
            $table->string("site_description")->nullable();
            $table->text("site_keywords")->nullable();
            $table->string("site_logo")->nullable();
            $table->string("site_favicon")->nullable();
            $table->boolean("auto_scraping")->nullable();
            $table->foreignId("scraping_site_id")->nullable()->constrained()->onDelete('set null');
            $table->boolean("slide_show")->nullable();
            $table->text("header_ads")->nullable();
            $table->text("footer_ads")->nullable();
            $table->text("single_ads")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
