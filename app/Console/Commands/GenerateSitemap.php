<?php

namespace App\Console\Commands;

use Log;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\Genre;
use App\Models\Category;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;

class GenerateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $chunkSize = 1000;

        $categorySitemapFiles = [];
        $genreSitemapFiles = [];
        $postSitemapFiles = [];

        if (!file_exists(public_path('sitemaps'))) {
            mkdir(public_path('sitemaps'), 0777, true);
        }

        // إنشاء ملفات سايت ماب للتصنيفات (Categories)
        Category::chunk($chunkSize, function ($categories, $page) use (&$categorySitemapFiles) {
            $categorySitemap = Sitemap::create();
            foreach ($categories as $category) {
                $categorySitemap->add(url('/category/' . $category->slug));
            }
            $sitemapFilePath = public_path('sitemaps/sitemap_categories_page_' . $page . '.xml');
            $categorySitemap->writeToFile($sitemapFilePath);
            $categorySitemapFiles[] = url('/sitemaps/sitemap_categories_page_' . $page . '.xml');
        });

        // إنشاء ملفات سايت ماب للأنواع (Genres)
        Genre::chunk($chunkSize, function ($genres, $page) use (&$genreSitemapFiles) {
            $genreSitemap = Sitemap::create();
            foreach ($genres as $genre) {
                $genreSitemap->add(url('/genre/' . $genre->slug));
            }
            $sitemapFilePath = public_path('sitemaps/sitemap_genres_page_' . $page . '.xml');
            $genreSitemap->writeToFile($sitemapFilePath);
            $genreSitemapFiles[] = url('/sitemaps/sitemap_genres_page_' . $page . '.xml');
        });

        // إنشاء ملفات سايت ماب للمقالات (Posts)
        Post::chunk($chunkSize, function ($posts, $page) use (&$postSitemapFiles) {
            $postSitemap = Sitemap::create();
            foreach ($posts as $post) {
                $postSitemap->add(
                    Url::create(url('/single/' . $post->slug))
                        ->setLastModificationDate(Carbon::create($post->updated_at))
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                        ->setPriority(1)
                );
            }
            $sitemapFilePath = public_path('sitemaps/sitemap_posts_page_' . $page . '.xml');
            $postSitemap->writeToFile($sitemapFilePath);
            $postSitemapFiles[] = url('/sitemaps/sitemap_posts_page_' . $page . '.xml');
        });

        // دمج جميع ملفات السايت ماب في الملف الرئيسي
        $mainSitemap = Sitemap::create();

        foreach (array_merge($categorySitemapFiles, $genreSitemapFiles, $postSitemapFiles) as $file) {
            $mainSitemap->add($file);
        }

        $mainSitemap->writeToFile(public_path('sitemap.xml'));

        Log::info("Sitemap generated successfully at " . date('Y-m-d H:i:s'));
    }
}
