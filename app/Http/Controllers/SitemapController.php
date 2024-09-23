<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Genre;
use App\Models\Keyword;
use App\Models\Category;
use Spatie\Sitemap\Sitemap;
use Illuminate\Support\Facades\URL;
use App\Models\Year;


class SitemapController extends Controller
{
    // public function index()
    // {
    //     $sitemap = Sitemap::create()
    //         ->add(Url::create(URL::to('/'))->setLastModificationDate(now())->setChangeFrequency('daily')->setPriority(1.0));

    //     // Example: Adding dynamic routes (e.g., from a Post model)
    //     $posts = \App\Models\Post::all();
    //     foreach ($posts as $post) {
    //         $sitemap->add(Url::create(URL::to('posts/' . $post->slug))
    //             ->setLastModificationDate($post->updated_at)
    //             ->setChangeFrequency('weekly')
    //             ->setPriority(0.9));
    //     }

    //     return response()->stream(
    //         function () use ($sitemap) {
    //             echo $sitemap->render();
    //         },
    //         200,
    //         ['Content-Type' => 'application/xml']
    //     );
    // }


    public function generateSitemaps()
    {
        $categorySitemap = Sitemap::create();
        Category::chunk(100, function ($categories) use ($categorySitemap) {
            foreach ($categories as $category) {
                $categorySitemap->add(url('/category/' . $category->slug));
            }
        });
        $categorySitemap->writeToFile(public_path('sitemap_categories.xml'));

        $postSitemap = Sitemap::create();
        Post::chunk(100, function ($posts) use ($postSitemap) {
            foreach ($posts as $post) {
                $postSitemap->add(url('/single/' . $post->slug));
            }
        });
        $postSitemap->writeToFile(public_path('sitemap_posts.xml'));

        $genreSitemap = Sitemap::create();
        Genre::chunk(100, function ($genres) use ($genreSitemap) {
            foreach ($genres as $genre) {
                $genreSitemap->add(url('/genre/' . $genre->slug));
            }
        });
        $genreSitemap->writeToFile(public_path('sitemap_genres.xml'));

        $keywordSitemap = Sitemap::create();
        Keyword::chunk(100, function ($keywords) use ($keywordSitemap) {
            foreach ($keywords as $keyword) {
                $keywordSitemap->add(url('/keyword/' . $keyword->slug));
            }
        });
        $keywordSitemap->writeToFile(public_path('sitemap_keywords.xml'));

        $yearSitemap = Sitemap::create();
        Year::chunk(100, function ($years) use ($yearSitemap) {
            foreach ($years as $year) {
                $yearSitemap->add(url('/year/' . $year->slug));
            }
        });
        $yearSitemap->writeToFile(public_path('sitemap_years.xml'));

        $mainSitemap = Sitemap::create();
        $mainSitemap->add(url('/sitemap_categories.xml'));
        $mainSitemap->add(url('/sitemap_posts.xml'));
        $mainSitemap->add(url('/sitemap_genres.xml'));
        $mainSitemap->add(url('/sitemap_keywords.xml'));
        $mainSitemap->add(url('/sitemap_years.xml'));
        $mainSitemap->writeToFile(public_path('sitemap.xml'));

        return response()->json(['message' => 'Sitemaps generated successfully.']);
    }
}
