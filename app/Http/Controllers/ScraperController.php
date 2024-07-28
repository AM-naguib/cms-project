<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;


class ScraperController extends Controller
{
    public function index()
    {
        $client = new Client();

        $website = $client->request('GET', 'https://t40.tuktukcinema1.buzz/%D9%85%D8%B3%D9%84%D8%B3%D9%84-the-kardashians-%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85-%D8%A7%D9%84%D8%AE%D8%A7%D9%85%D8%B3-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-5/');



        $data = $website->filter("body > section.Single--Container > div > div > div.MasterSingleMeta > h1 > a")->each(function ($node) {
            dump($node->text());
        });
        // dd($data);
        // $companies = $website->filter('h4 > a')->each(function ($node) {
        //     dump($node->text());
        // });
    }


    public function checkData(Request $request)
    {

        $ex_url = $request->postUrl;
        $site_name = $request->site_name;
        $site_url = $request->site_url;
        $selectors["title_selector"] = $request->title_selector;
        $selectors["description_selector"] = $request->description_selector;
        $selectors["category_selector"] = $request->category_selector;
        $selectors["quality_selector"] = $request->quality_selector;
        $selectors["year_selector"] = $request->year_selector;
        $selectors["episode_number_selector"] = $request->episode_number_selector;
        $selectors["duration_selector"] = $request->duration_selector;
        $selectors["genre_selector"] = $request->genre_selector;
        $selectors["keyword_selector"] = $request->keyword_selector;
        $selectors["image_url_selector"] = $request->image_url_selector;
        $selectors["season_selector"] = $request->season_selector;
        $selectors["watch_urls_selector"] = $request->watch_urls_selector;
        $selectors["download_urls_selector"] = $request->download_urls_selector;


        $client = new Client();

        $website = $client->request('GET', $ex_url);
        $data = [];
        foreach ($selectors as $key => $selector) {
            // $data[$key] =
            if ($key == "watch_urls_selector" || $key == "download_urls_selector") {
                $newUrl = $ex_url . "/watch";

                $website = $client->request('GET', $newUrl);
                $data[$key] = $this->getData($website, $selector);

            }else{
                $data[$key] = $this->getData($website, $selector);

            }

        }
        dd($data);

    }
    public function getData($website, $selector)
    {
        $data = [];
        $website->filter($selector)->each(function ($node) use (&$data, $selector) {
            if (strpos($selector, "img") !== false) {
                $data[] = $node->attr('src');
            }elseif(strpos($selector, "watch" || strpos($selector, "download") || strpos($selector, "server") ) !== false){
                $data[] = $node->attr('data-link');
            }
             else {
                $data[] = $node->text();

            }
        });
        return $data;
    }

}
