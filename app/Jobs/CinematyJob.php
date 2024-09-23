<?php

namespace App\Jobs;

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
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\Dash\PostController;


class CinematyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ScrapPostTrait;

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
            $data = $this->cinematy($this->url);
            $this->addPost($data);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }


    public function cinematy($url)
    {
        $selectors = [
            "title" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > h1",
            "description" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.story > p",
            "category" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleInfoCon > div > div:nth-child(1) > ul > li:nth-child(2) > a",
            "lang" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleInfoCon > div > div:nth-child(3) > ul > li:nth-child(2) > a",
            "age" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleInfoCon > div > div:nth-child(5) > ul > li:nth-child(2) > a",
            "year" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleInfoCon > div > div:nth-child(7) > ul > li:nth-child(2) > a",
            "state" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleInfoCon > div > div:nth-child(2) > ul > li:nth-child(2) > a",
            "genres" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleInfoCon > div > div:nth-child(4) > ul > li > a",
            "quality" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleInfoCon > div > div:nth-child(6) > ul > li:nth-child(2) > a",
            "img_url" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-3.col-sm-3.col-xs-12.colPoster.fRight > div.posterWrapper > div",
            "actors" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleTax > div > div > div:nth-child(1) > ul:nth-child(2) > li> a ",
            "img" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-3.col-sm-3.col-xs-12.colPoster.fRight > div.posterWrapper > div"
        ];

        $postData = [];
        $client = new Client();
        $mainPost = $client->request('GET', $url);

        // get download servers
        $downloadUrl = $mainPost->filter('body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleBtns > a.btn.download')->attr("href");
        $downloadBody = $client->request('GET', $downloadUrl);
        $downloadSelector = "body > div.singleWrapper > div > div > div:nth-child(2) > div > div > div > ul > a";

        $downloadBody->filter($downloadSelector)->each(function ($node) use (&$postData) {
            $postData["download_urls"][$node->text()] = $node->attr("href");

        });
        // get watch servers
        $watchUrl = $mainPost->filter('body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleBtns > a.btn.watch');
        $watchUrl = $watchUrl->attr("href");

        parse_str(parse_url($watchUrl, PHP_URL_QUERY), $params);
        $watchServers = json_decode(base64_decode($params['post'] ?? ''), true);
        $postData["watch_urls"] = $watchServers;


        foreach ($selectors as $key => $value) {
            $mainPost->filter($value)->each(function ($node) use (&$postData, $key) {
                if ($node->attr("class") == "poster") {
                    $imgUrl = $node->attr('style');
                    if (preg_match('/url\((.*?)\)/', $imgUrl, $matches)) {
                        $postData[$key][] = trim($matches[1], '"');
                    }
                } else {
                    $postData[$key][] = $node->text();
                }

            });
        }

        return $postData;

    }


}
