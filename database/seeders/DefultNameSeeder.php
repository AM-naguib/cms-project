<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Genre;
use App\Models\MainCategory;
use App\Models\MainName;
use App\Models\Quality;
use App\Models\Setting;
use App\Models\Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefultNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MainCategory::firstOrCreate([
            "name" => "unmaincategory",
            "slug" => "unmaincategory",
        ]);

        Category::firstOrCreate([
            "name" => "uncategorized",
            "slug" => "uncategorized",
        ]);

        Year::firstOrCreate([
            "name" => 0000,
            "slug" => "0000",
        ]);

        MainName::firstOrCreate([
            "name" => "unknown",
            "slug" => "unknown",
        ]);

        Quality::firstOrCreate([
            "name" => "unknown",
            "slug" => "unknown",
        ]);

        Genre::firstOrCreate([
            "name" => "unknown",
            "slug" => "unknown",
        ]);

        Setting::firstOrCreate([
            "site_title" => "Site Title",
        ]);



    }
}
