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
            $table->string("newly_url")->nullable();
            $table->text("post_selector")->nullable();
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
