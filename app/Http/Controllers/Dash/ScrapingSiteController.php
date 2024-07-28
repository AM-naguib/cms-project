<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\ScrapingSite;
use Illuminate\Http\Request;

class ScrapingSiteController extends Controller
{
    public function index(){
        $sites = ScrapingSite::get();
        return view("dashboard.scraping_sites.index",compact("sites"));
    }
    public function create(){
        return view("dashboard.scraping_sites.create");
    }
    public function store(Request $request){
        $data = $request->validate([
            "site_name" => "required|unique:scraping_sites,site_name",
            "site_url" => "required|unique:scraping_sites,site_url",
            "title_selector" => "nullable",
            "description_selector" => "nullable",
            "watch_urls_selector" => "nullable",
            "download_urls_selector" => "nullable",
            "category_selector" => "nullable",
            "quality_selector" => "nullable",
            "year_selector" => "nullable",
            "episode_number_selector" => "nullable",
            "duration_selector" => "nullable",
            "image_url_selector" => "nullable",
            "season_selector" => "nullable",
        ]);

        ScrapingSite::create($data);
        toastr()->success('Scraping Site Created Successfully');
        return redirect()->route("dashboard.scraping_sites.index");


    }



    public function edit(ScrapingSite $scraping_site){
        return view("dashboard.scraping_sites.edit",compact("scraping_site"));
    }

    public function update(Request $request, $scraping_site){

    }
}
