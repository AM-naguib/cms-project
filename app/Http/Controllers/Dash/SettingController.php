<?php

namespace App\Http\Controllers\Dash;

use App\Models\ScrapingSite;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index(){


        $settings = Setting::first();
        $scraping_sites = ScrapingSite::get();
        return view("dashboard.settings.index",compact("settings","scraping_sites"));
    }

    public function update(Request $request){
        $data = $request->validate([
            "site_title"=>["string","nullable"],
            "site_description"=>["string","nullable"],
            "site_keywords"=>["string","nullable"],
            "auto_scraping"=>["nullable"],
            "scraping_site_id"=>["nullable","exists:scraping_sites,id"],
            "slide_show"=>["nullable","boolean"],
            "site_favicon"=>["nullable","mimes:ico"],
            "site_logo"=>["nullable","mimes:jpg,jpeg,png,html,webp"],
            "header_ads"=>["string","nullable"],
            "footer_ads"=>["string","nullable"],
            "single_ads"=>["string","nullable"],
        ]);

        $settings = Setting::first();

        if ($request->hasFile("site_favicon")) {
            $file = $request->file("site_favicon");
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads', $fileName);
            $data["site_favicon"] = "uploads/".$fileName;
        }
        if ($request->hasFile("site_logo")) {
            $file = $request->file("site_logo");
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads', $fileName);
            $data["site_logo"] = "uploads/".$fileName;
        }

        $settings->update($data);
        return to_route("dashboard.settings.index");

    }
}
