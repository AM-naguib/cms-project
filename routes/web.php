<?php

use App\Http\Controllers\Dash\ScrapingSiteController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\Dash\PostController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Dash\CategoryController;
use App\Http\Controllers\Dash\DashboardController;

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


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix("dashboard")->name('dashboard.')->group(function () {
    Route::get("/", [DashboardController::class, "index"])->name("index");
    Route::resource('categories', CategoryController::class)->except("show");
    Route::resource('posts', PostController::class)->except("show");
    Route::resource("scraping_sites",ScrapingSiteController::class)->except("show");
    // Route::get("check_data",[ScraperController::class,"checkData"])->name("check_data");
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';




Route::name("front.")->group(function () {
    Route::get("/", [HomeController::class, "index"])->name("index");
    Route::get("index", [HomeController::class, "index"])->name("index");
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
        'Accept-Encoding' => 'gzip, deflate,  zstd',
        'Accept-Language' => 'en-EG,en;q=0.9,ar-EG;q=0.8,ar;q=0.7,en-GB;q=0.6,en-US;q=0.5',
        'Referer' => 'https://t40.tuktukcinema1.buzz/',
        'Sec-Ch-Ua' => '"Not/A)Brand";v="8", "Chromium";v="126", "Google Chrome";v="126"',
        'Sec-Ch-Ua-Mobile' => '?0',
        'Sec-Ch-Ua-Platform' => '"Windows"',
        'Sec-Fetch-Dest' => 'iframe',
        'Sec-Fetch-Mode' => 'navigate',
        'Sec-Fetch-Site' => 'cross-site',
        'Upgrade-Insecure-Requests' => '1',
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
    ])->get('https://cdn4.1vid1shar.space/embed-8g71s74qjsd1.html');


    echo "<iframe src='https://cdn4.1vid1shar.space/embed-8g71s74qjsd1.html'></iframe>";
    // To get the response body
    dd($response->body());
    $body = $response->body();

    // To get the status code
    $statusCode = $response->status();

    // To get headers
    $headers = $response->headers();
});



Route::get("scrap",[ScraperController::class,"index"]);
