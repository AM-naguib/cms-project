<?php

namespace App\Jobs;

use Log;
use Goutte\Client;
use App\Models\Post;
use App\Models\Year;
use App\Models\Genre;
use App\Models\Quality;
use App\Models\Category;
use App\Models\MainName;
use Illuminate\Support\Str;
use App\Models\MainCategory;
use Illuminate\Bus\Queueable;
use App\Traits\ScrapPostTrait;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\Dash\PostController;


class TuktukJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,ScrapPostTrait;

    /**
     * Create a new job instance.
     */

     public $url;
    public function __construct($link)
    {
        $this->url = $link;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $data = $this->tuktukcinema($this->url);
            $this->addPost($data);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
    public function tuktukcinema($url)
    {
        $selectors = [
            "title" => "body > section.Single--Container > div > div > div.MasterSingleMeta > h1 > a",
            "description" => "body > section.Single--Container > div > div > div.MasterSingleMeta > div.story > p",
            "lang" => "body > section.Single--Container > div > div > div.MasterSingleMeta > div.MediaQueryRight > ul > li:nth-child(3) > a",
            "age" => "body > section.Single--Container > div > div > div.MasterSingleMeta > div.MediaQueryRight > ul > li:nth-child(6) > a",
            "year" => "body > section.Single--Container > div > div > div.MasterSingleMeta > div.MediaQueryRight > ul > li:nth-child(2) > a",
            "state" => "body > section.Single--Container > div > div > div.MasterSingleMeta > div.MediaQueryRight > ul > li:nth-child(5) > a",
            "genres" => "body > section.Single--Container > div > div > div.MasterSingleMeta > div.MediaQueryRight > div > li:nth-child(2) > a",
            "quality" => "body > section.Single--Container > div > div > div.MasterSingleMeta > div.MediaQueryRight > ul > li:nth-child(4) > a",
            "category" => "body > section.Single--Container > div > div > div.MasterSingleMeta > div.MediaQueryRight > div > li:nth-child(1) > a",
            "img_url" => "body > section.Single--Container > div > div > div.left > div.image > img",
            "actors" => "body > section.Single--Container > div > div > div.MasterSingleMeta > div.MediaQueryRight > ul > li:nth-child(9) > a",
        ];
        $postData = [];
        $client = new Client();
        $mainPost = $client->request('GET', $url);
        $watchAndDowLink = $mainPost->filter('body > section.Single--Container > div > div > div.MasterSingleMeta > div.MediaQueryLeft > div > a')->attr("href");
        $wat = $client->request('GET', $watchAndDowLink);

        $watchServersSelector = "body > div.watch--area > div.watch--servers--list > ul > li";

        $wat->filter($watchServersSelector)->each(function ($node) use (&$postData) {

            $postData["watch_urls"][] = $node->attr('data-link');

        });

        $dowenServersSelector = "body > div.watch--area > div.watch--servers--list > div.downloads > a";
        $wat->filter($dowenServersSelector)->each(function ($node) use (&$postData) {

            $postData["download_urls"][] = $node->attr('href');

        });
        foreach ($selectors as $key => $value) {
            $mainPost->filter($value)->each(function ($node) use (&$postData, $key) {
                if ($node->attr("src")) {
                    $imgUrl = $node->attr('src');
                    $postData[$key][] = $imgUrl;
                    // if (preg_match('/url\((.*?)\)/', $imgUrl, $matches)) {
                    //     $postData[$key][] = trim($matches[1], '"');
                    // }
                } else {
                    $postData[$key][] = $node->text();
                }

            });
        }
        return $postData;
    }


}
