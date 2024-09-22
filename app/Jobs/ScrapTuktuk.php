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
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\Dash\PostController;


class ScrapTuktuk implements ShouldQueue
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
            $data = $this->tuktukcinema($this->url);

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
