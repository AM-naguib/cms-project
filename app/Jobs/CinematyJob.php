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
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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

            $findPost = Post::where("slug", Str::slug($data["title"][0]))->first();
            if ($findPost) {
                Log::info("Post already exists");
                return;
            }

            $title = $data["title"][0];
            $imgUrl = $this->imageSave($data["img_url"][0]);
            $details = $this->extractDetailsFromTitle($title);
            $slug = Str::slug($data["category"][0]);
            $getMainCategoryName = explode(" ", $data["category"][0]);
            $mainCategory = MainCategory::firstOrCreate(["name" => $getMainCategoryName[0], "slug" => Str::slug($getMainCategoryName[0])]);
            $category = Category::where('name', trim($data["category"][0]))->orWhere('slug', $slug)->first();

            if (!$category) {
                $category = Category::create([
                    "name" => trim($data["category"][0]),
                    "slug" => $slug,
                    "main_category_id" => $mainCategory->id
                ]);
            }

            $qualityName = $data["quality"][0] ?? 'Default Quality';
            $yearName = $data["year"][0] ?? 1;

            $quality = Quality::firstOrCreate(["name" => trim($qualityName), "slug" => Str::slug($qualityName)]);
            $yearName = explode(" ", $yearName)[0];
            $year = Year::firstOrCreate(["name" => trim($yearName), "slug" => Str::slug($yearName)]);

            $mainName = $details["name"] ?? 'Unknown Name';
            $main_name = MainName::firstOrCreate(["name" => trim($mainName), "slug" => Str::slug($mainName)]);

            $post = Post::create([
                "title" => $data["title"][0],
                "slug" => Str::slug($data["title"][0]),
                "description" => $data["description"][0] ?? '',
                "watch_urls" => json_encode($data["watch_urls"] ?? []),
                "download_urls" => json_encode($data["download_urls"] ?? []),
                "category_id" => $category->id,
                "main_name_id" => $main_name->id,
                "quality_id" => $quality->id,
                "year_id" => $year->id,
                "episode_number" => $details["episode"] ?? 0,
                "duration" => '15',
                "status" => 1,
                "image_url" => $imgUrl ?? null,
            ]);
            if(empty($data["keywords"]) || $data["keywords"] == null){
                $contoller = new PostController;
                $contoller->addDefaultKeywords($post);
            }

            foreach ($data["genres"] as $genre) {
                $genre = Genre::firstOrCreate(["name" => trim($genre), "slug" => Str::slug($genre)]);
                $post->genres()->attach($genre);
            }
            Artisan::call('sitemap:generate');

            Log::info("Post Added Successfully");
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

    function extractDetailsFromTitle($title)
    {
        $type = null;
        if (strpos($title, 'مسلسل') !== false) {
            $type = 'مسلسل';
        } elseif (strpos($title, 'فيلم') !== false) {
            $type = 'فيلم';
        }

        $name = null;
        if (preg_match('/(?:مسلسل|فيلم)\s+(.+?)(?=\s+الموسم|\s+الحلقة|\s+\d+|\s+مترجمة|$)/u', $title, $matches)) {
            $name = $matches[1];
        }

        $season = null;
        if (preg_match('/الموسم\s+(\w+)/u', $title, $matches)) {
            $season = $matches[1];
        }

        $episode = null;
        if (preg_match('/الحلقة\s+(\d+)/u', $title, $matches)) {
            $episode = $matches[1];
        }

        return [
            'type' => $type,
            'name' => trim($name),  // إزالة المسافات الزائدة
            'season' => $season,
            'episode' => $episode
        ];
    }




    public function imageSave($url)
    {
        $imageContents = file_get_contents($url);
        $imageName = hexdec(uniqid('')) . '.' . pathinfo($url, PATHINFO_EXTENSION);
        Storage::put('public/uploads/' . $imageName, $imageContents);
        return "uploads/" . $imageName;
    }
}
