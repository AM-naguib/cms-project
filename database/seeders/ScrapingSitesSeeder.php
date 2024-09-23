<?php

namespace Database\Seeders;

use App\Models\ScrapingSite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScrapingSitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScrapingSite::create([
            "site_name"=>"cinematy",
            "site_url"=>"https://cdn-01.cinematy.click",
            "newly_url"=>"https://cdn-01.cinematy.click/newly/",
            "post_selector"=>"body > section > div.sec-line > div > div > div > article > div > div > a"
        ]);
    }
}
