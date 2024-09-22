<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;
use Spatie\Sitemap\Sitemap;


class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create(URL::to('/'))->setLastModificationDate(now())->setChangeFrequency('daily')->setPriority(1.0));

        // Example: Adding dynamic routes (e.g., from a Post model)
        $posts = \App\Models\Post::all();
        foreach ($posts as $post) {
            $sitemap->add(Url::create(URL::to('posts/' . $post->slug))
                ->setLastModificationDate($post->updated_at)
                ->setChangeFrequency('weekly')
                ->setPriority(0.9));
        }

        return response()->stream(
            function () use ($sitemap) {
                echo $sitemap->render();
            },
            200,
            ['Content-Type' => 'application/xml']
        );
    }
}
