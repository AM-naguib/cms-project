<?php

use Goutte\Client;
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

    Route::resource("main-categories",MainCategoryController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource("years",YearController::class);

    Route::resource("genres",GenreController::class);

    Route::resource("keywords",KeywordController::class);

    Route::resource('posts', PostController::class)->except("show");

    Route::resource("scraping_sites",ScrapingSiteController::class)->except("show");


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

});









Route::get('/sitemap', [SitemapController::class, 'generateSitemaps']);
