<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Category;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapIndex;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Generate an XML Sitemap';

    /**
     * Execute the console command.
     */
public function handle()
{
    // إنشاء خريطة الموقع الرئيسية
    $sitemapIndex = SitemapIndex::create();

    // إنشاء خريطة الموقع للتصنيفات
    $categoriesSitemap = Sitemap::create();
    Category::all()->each(function ($category) use ($categoriesSitemap) {
        $categoriesSitemap->add(
            Url::create("/category/{$category->slug}")
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
        );
    });
    $categoriesSitemap->writeToFile(public_path('sitemap-categories.xml'));

    // إضافة خريطة الموقع للتصنيفات إلى الخريطة الرئيسية
    $sitemapIndex->add('/sitemap-categories.xml');

    // إنشاء خريطة الموقع للمشاركات
    $postsPerPage = 100;
    $totalPosts = Post::count();
    $totalPages = ceil($totalPosts / $postsPerPage);

    for ($page = 1; $page <= $totalPages; $page++) {
        $postsSitemap = Sitemap::create();

        // جلب المشاركات للصفحة الحالية
        $posts = Post::skip(($page - 1) * $postsPerPage)
            ->take($postsPerPage)
            ->get();

        // إضافة روابط المشاركات إلى خريطة الموقع
        $posts->each(function (Post $post) use ($postsSitemap) {
            $postsSitemap->add(
                Url::create("/single/{$post->slug}")
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_HOURLY)
            );
        });

        // حفظ خريطة الموقع للمشاركات إلى ملف
        $postsSitemap->writeToFile(public_path("sitemap-posts-page-{$page}.xml"));

        // إضافة كل ملف خريطة موقع للمشاركات إلى الخريطة الرئيسية
        $sitemapIndex->add("/sitemap-posts-page-{$page}.xml");
    }

    // حفظ خريطة الموقع الرئيسية إلى الملف
    $sitemapIndex->writeToFile(public_path('sitemap.xml'));
}
}
