<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Dash\PostController;
use Goutte\Client;
use App\Models\Post;
use App\Models\Year;
use App\Models\Genre;
use App\Models\Quality;
use App\Models\Category;
use App\Models\MainName;
use Illuminate\Support\Str;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;


class ScraperController extends Controller
{



    public function go()
    {
        $data = "https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-power-book-ii-ghost-%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85-%D8%A7%D9%84%D8%B1%D8%A7%D8%A8%D8%B9-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-7/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-%D8%A7%D9%84%D8%AF%D9%85-%D8%A7%D9%84%D9%81%D8%A7%D8%B3%D8%AF-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-2-%D9%85%D8%AA%D8%B1%D8%AC%D9%85%D8%A9/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-fight-night-the-million-dollar-heist-%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85-%D8%A7%D9%84%D8%A7%D9%88%D9%84-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-4/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-fight-night-the-million-dollar-heist-%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85-%D8%A7%D9%84%D8%A7%D9%88%D9%84-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-3/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-fight-night-the-million-dollar-heist-%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85-%D8%A7%D9%84%D8%A7%D9%88%D9%84-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-2/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-%D8%B9%D8%AA%D9%85%D8%A9-black-out-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-9/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-%D9%85%D9%85%D8%AD%D8%A7%D8%A9-%D8%A7%D9%84%D8%B0%D8%A7%D9%83%D8%B1%D8%A9-%D8%A7%D9%84%D8%B3%D9%8A%D8%A6%D8%A9-bad-memory-eraser-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-13/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-%D8%B4%D8%B1%D9%8A%D9%83-%D8%AC%D9%8A%D8%AF-good-partner-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-14/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-how-to-die-alone-%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85-%D8%A7%D9%84%D8%A7%D9%88%D9%84-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-1/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-how-to-die-alone-%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85-%D8%A7%D9%84%D8%A7%D9%88%D9%84-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-2/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-how-to-die-alone-%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85-%D8%A7%D9%84%D8%A7%D9%88%D9%84-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-3/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-how-to-die-alone-%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85-%D8%A7%D9%84%D8%A7%D9%88%D9%84-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-4/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-in-vogue-the-90s-%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85-%D8%A7%D9%84%D8%A7%D9%88%D9%84-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-1/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-in-vogue-the-90s-%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85-%D8%A7%D9%84%D8%A7%D9%88%D9%84-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-2/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-in-vogue-the-90s-%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85-%D8%A7%D9%84%D8%A7%D9%88%D9%84-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-3/
https://eg.tuktuksu.cfd/%D9%85%D8%B3%D9%84%D8%B3%D9%84-en-fin-%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%85-%D8%A7%D9%84%D8%A7%D9%88%D9%84-%D8%A7%D9%84%D8%AD%D9%84%D9%82%D8%A9-6-%D9%88%D8%A7%D9%84%D8%A7%D8%AE%D9%8A%D8%B1%D8%A9/
";
        $urlsArray = explode("\n", $data);
        $res = [];
        foreach ($urlsArray as $url) {
            $res[]=$this->addPost($url);
        }

        dd($res);
    }
    public function addPost($url = null)
    {
        try {
            $siteName = "tuktukcinema";

            $data = $this->$siteName($url);

            $findPost = Post::where("slug", Str::slug($data["title"][0]))->first();
            if ($findPost) {
                return $findPost;
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

            return $post;
        } catch (\Exception $e) {
            // يمكنك تسجيل الخطأ هنا أو إعادته للاستفادة منه لاحقاً
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
            "img_url" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleInfoCon > div > div:nth-child(1) > ul > li:nth-child(1) > a > img",
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
        $watchUrl = $mainPost->filter('body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleBtns > a.btn.watch')->attr("href");
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
    public function scrap()
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
            "img_url" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleInfoCon > div > div:nth-child(1) > ul > li:nth-child(1) > a > img",
            "actors" => "body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleTax > div > div > div:nth-child(1) > ul:nth-child(2) > li> a "
        ];

        $after = [];
        $client = new Client();
        $mainPost = $client->request('GET', 'https://cdn-01.cinematy.click/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-the-twelve-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82%d8%a9-7-%d9%85%d8%aa%d8%b1%d8%ac%d9%85%d8%a9/');



        // get download servers
        $downloadUrl = $mainPost->filter('body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleBtns > a.btn.download')->attr("href");
        $downloadBody = $client->request('GET', $downloadUrl);
        $downloadSelector = "body > div.singleWrapper > div > div > div:nth-child(2) > div > div > div > ul > a";

        $downloadBody->filter($downloadSelector)->each(function ($node) use (&$after) {
            $after["download_urls"][$node->text()] = $node->attr("href");

        });

        // get watch servers
        $watchUrl = $mainPost->filter('body > div.singleWrapper > div > div > div.row.nm > div.col-md-9.col-sm-9.col-xs-12.colInfo > div > div.singleBtns > a.btn.watch')->attr("href");
        parse_str(parse_url($watchUrl, PHP_URL_QUERY), $params);
        $watchServers = json_decode(base64_decode($params['post'] ?? ''), true);
        $after["watch_urls"] = $watchServers;


        foreach ($selectors as $key => $value) {
            $mainPost->filter($value)->each(function ($node) use (&$after, $key) {
                if ($node->attr("class") == "poster") {
                    $imgUrl = $node->attr('style');
                    if (preg_match('/url\((.*?)\)/', $imgUrl, $matches)) {
                        $after[$key][] = trim($matches[1], '"');
                    }
                } else {
                    $after[$key][] = $node->text();
                }

            });
        }

        dd($after);
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
