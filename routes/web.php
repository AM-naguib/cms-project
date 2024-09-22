<?php

use App\Http\Controllers\Dash\KeywordController;
use Goutte\Client;
use App\Models\ScrapingSite;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\Dash\PostController;
use App\Http\Controllers\Dash\YearController;
use App\Http\Controllers\Dash\GenreController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Dash\SettingController;
use App\Http\Controllers\Dash\CategoryController;
use App\Http\Controllers\Dash\DashboardController;
use App\Http\Controllers\Dash\MainCategoryController;
use App\Http\Controllers\Dash\ScrapingSiteController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::middleware('auth')->prefix("dashboard")->name('dashboard.')->group(function () {
    Route::get("/", [DashboardController::class, "index"])->name("index");

    Route::resource("main-categories",MainCategoryController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource("years",YearController::class);

    Route::resource("genres",GenreController::class);

    Route::resource("keywords",KeywordController::class);

    Route::resource('posts', PostController::class)->except("show");

    Route::resource("scraping_sites",ScrapingSiteController::class)->except("show");

    // Route::get("check_data",[ScraperController::class,"checkData"])->name("check_data");

    Route::get("settings",[SettingController::class,"index"])->name("settings.index");

    Route::post("settings",[SettingController::class,"update"])->name("settings.update");


});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';




Route::name("front.")->group(function () {
    Route::get("/", [HomeController::class, "index"])->name("index");
    // Route::get("index", [HomeController::class, "index"])->name("index");
    Route::get("new",[HomeController::class, "new"])->name("new");
    Route::get("single/{slug}",[HomeController::class, "single"])->name("single");

    Route::get("/{page}/{item}",[HomeController::class,"page"])->name("page");
    // Route::get("category/{cat}",[HomeController::class, "category"])->name("category");

});













Route::get("cima4u", function () {

    $response = Http::withHeaders([
        'accept' => '*/*',
        'referer' => 'https://cima4u.shop/',
        'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
        'x-requested-with' => 'XMLHttpRequest',
    ])->get('https://cima4u.shop/wp-content/themes/vo2024/temp/ajax/iframe.php', [
                'id' => '145764',
                'video' => '6',
            ]);

    if ($response->successful()) {
        dd($response->body());
        echo $response->body();
    } else {
        echo "Request failed with status: " . $response->status();
    }

});



Route::get("wecima", function () {
    $response = Http::withHeaders([
        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
        'Accept-Language' => 'en-US',
        'Sec-Ch-Ua' => '"Chromium";v="127", "Not)A;Brand";v="99"',
        'Sec-Ch-Ua-Mobile' => '?0',
        'Sec-Ch-Ua-Platform' => '"Windows"',
        'Sec-Fetch-Site' => 'same-origin',
        'Sec-Fetch-Mode' => 'navigate',
        'Sec-Fetch-Dest' => 'empty',
        'Referer' => 'https://t40.tuktukcinema1.buzz/%D9%81%D9%8A%D9%84%D9%85-strange-darling-2023-%D9%85%D8%AA%D8%B1%D8%AC%D9%85-%D8%A7%D9%88%D9%86-%D9%84%D8%A7%D9%8A%D9%86/',
    ])->withCookies([
        '_ga_01RRNSWRP8' => 'GS1.1.1724937632.1.0.1724937632.0.0.0',
        '_ga' => 'GA1.1.920877554.1724937633',
        'prefetchAd_6547300' => 'true',
    ], 't40.tuktukcinema1.buzz')->get('https://t40.tuktukcinema1.buzz/%D9%81%D9%8A%D9%84%D9%85-strange-darling-2023-%D9%85%D8%AA%D8%B1%D8%AC%D9%85-%D8%A7%D9%88%D9%86-%D9%84%D8%A7%D9%8A%D9%86/watch/');

    // Output or process the response
    $content = $response->body();
    return $content;
});



Route::get("scrap",[ScraperController::class,"index"]);


Route::get("ssss", function () {
    $site = ScrapingSite::first()->toArray();
    unset($site['id'], $site['created_at'], $site['updated_at'], $site['site_url'], $site['site_name']);
    $url = "https://t40.tuktukcinema1.buzz/%D9%81%D9%8A%D9%84%D9%85-dead-sea-2024-%D9%85%D8%AA%D8%B1%D8%AC%D9%85-%D8%A7%D9%88%D9%86-%D9%84%D8%A7%D9%8A%D9%86/";

    $client = new Client();
    $website = $client->request('GET', $url);
    $watchUrl = $client->request('GET', $url."/watch");
    $data = [];

    foreach ($site as $key => $selector) {

        if (is_null($selector) || $selector === '') {
            continue; // Skip if the selector is null or empty
        }
        // $data[$key] = $selector;
        if(strpos($selector, "downloads") !== false){

        }
        $website->filter($selector)->each(function ($node) use (&$data, $selector, $key) {
            if (strpos($selector, "img") !== false) {
                $data[$key][] = $node->attr('src');
            } elseif (strpos($selector, "watch")  !== false) {

                $data[$key][] = $node->attr('data-link');
            }elseif (strpos($selector, "downloads")  !== false) {
                $data[$key][] = $node->attr('data-link');
            }
             else {
                $data[$key][] = $node->text();
            }
        });
    }

    // You can return or process the $data as needed
    return response()->json($data);
});



Route::get("test",[ScraperController::class,"test"]);
