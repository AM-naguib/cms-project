<?php

use Goutte\Client;
use App\Jobs\CinematyJob;
use App\Models\ScrapingSite;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Dash\PostController;
use App\Http\Controllers\Dash\YearController;
use App\Http\Controllers\Dash\GenreController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Dash\KeywordController;
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

    Route::resource("main-categories", MainCategoryController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource("years", YearController::class);

    Route::resource("genres", GenreController::class);

    Route::resource("keywords", KeywordController::class);

    Route::resource('posts', PostController::class)->except("show");

    Route::resource("scraping_sites", ScrapingSiteController::class)->except("show");


    Route::get("settings", [SettingController::class, "index"])->name("settings.index");

    Route::post("settings", [SettingController::class, "update"])->name("settings.update");


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

    Route::get("new", [HomeController::class, "new"])->name("new");

    Route::get("single/{slug}", [HomeController::class, "single"])->name("single");

    Route::get("/{page}/{item}", [HomeController::class, "page"])->name("page");

});









Route::get('/sitemap', [SitemapController::class, 'generateSitemaps']);



Route::get("add-posts", function () {
    $urls = "https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%ad%d8%af%d9%88%d8%aa%d8%a9-%d9%85%d9%8f%d8%b1%d8%a9-%d8%a7%d9%84%d8%ad%d9%84%d9%82%d8%a9-2/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%ad%d8%af%d9%88%d8%aa%d8%a9-%d9%85%d9%8f%d8%b1%d8%a9-%d8%a7%d9%84%d8%ad%d9%84%d9%82%d8%a9-1/
https://cinematyko.online/series/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%ad%d8%af%d9%88%d8%aa%d8%a9-%d9%85%d9%8f%d8%b1%d8%a9-%d9%83%d8%a7%d9%85%d9%84/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%84%d8%ab-%d8%a7%d9%84%d8%ad%d9%84%d9%82-14/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%84%d8%ab-%d8%a7%d9%84%d8%ad%d9%84%d9%82-13/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%84%d8%ab-%d8%a7%d9%84%d8%ad%d9%84%d9%82-12/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%84%d8%ab-%d8%a7%d9%84%d8%ad%d9%84%d9%82-11/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%84%d8%ab-%d8%a7%d9%84%d8%ad%d9%84%d9%82-10/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%84%d8%ab-%d8%a7%d9%84%d8%ad%d9%84%d9%82-9/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%84%d8%ab-%d8%a7%d9%84%d8%ad%d9%84%d9%82-8/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%84%d8%ab-%d8%a7%d9%84%d8%ad%d9%84%d9%82-7/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%84%d8%ab-%d8%a7%d9%84%d8%ad%d9%84%d9%82-6/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%84%d8%ab-%d8%a7%d9%84%d8%ad%d9%84%d9%82-5/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%84%d8%ab-%d8%a7%d9%84%d8%ad%d9%84%d9%82-4/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%84%d8%ab-%d8%a7%d9%84%d8%ad%d9%84%d9%82-3/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%84%d8%ab-%d8%a7%d9%84%d8%ad%d9%84%d9%82-2/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%84%d8%ab-%d8%a7%d9%84%d8%ad%d9%84%d9%82/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-27/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-26/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-25/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-24/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-23/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-22/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-21/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-20/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-19/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-18/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-17/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-16/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-15/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-14/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-13/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-12/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-11/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-10/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-9/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-8/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-7/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-6/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-5/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-4/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-3/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82-2/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%ab%d8%a7%d9%86%d9%8a-%d8%a7%d9%84%d8%ad%d9%84%d9%82/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%a7%d9%88%d9%84-%d8%a7%d9%84%d8%ad%d9%84%d9%82%d8%a9-15/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%a7%d9%88%d9%84-%d8%a7%d9%84%d8%ad%d9%84%d9%82%d8%a9-14/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%a7%d9%88%d9%84-%d8%a7%d9%84%d8%ad%d9%84%d9%82%d8%a9-13/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%a7%d9%88%d9%84-%d8%a7%d9%84%d8%ad%d9%84%d9%82%d8%a9-12/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%a7%d9%88%d9%84-%d8%a7%d9%84%d8%ad%d9%84%d9%82%d8%a9-11/
https://cinematyko.online/episodes/%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%b1%d8%a3%d9%81%d8%aa-%d8%a7%d9%84%d9%87%d8%ac%d8%a7%d9%86-%d8%a7%d9%84%d9%85%d9%88%d8%b3%d9%85-%d8%a7%d9%84%d8%a7%d9%88%d9%84-%d8%a7%d9%84%d8%ad%d9%84%d9%82%d8%a9-10/";
    $urlsArray = explode("\n", $urls);

    foreach ($urlsArray as $url) {
        CinematyJob::dispatch($url);
    }
});
