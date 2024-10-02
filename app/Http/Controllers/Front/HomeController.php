<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Models\Category;
use App\Models\Year;
use Carbon\CarbonInterval;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Spatie\SchemaOrg\Schema;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        $posts = Post::where('status', 1);
        $headerSlider = $posts->orderBy('id', 'desc')->take(5)->get();
        $posts = $posts->orderBy('id', 'desc')->paginate(12);
        $mainCategories = MainCategory::where("id", "!=", 1)->with('categories')->get();
        foreach ($mainCategories as $mainCategory) {
            $categoryIds = $mainCategory->categories->pluck('id');
            $latestPosts = Post::whereIn('category_id', $categoryIds)
                ->latest()
                ->take(10)
                ->get();

            $mainCategory->latestPosts = $latestPosts;
        }

        return view('front.index', compact('posts', "mainCategories", "headerSlider"));
    }





    public function page($page, $item)
    {
        $page = ucfirst($page);

        $modelClass = '\App\Models\\' . $page;

        if (!class_exists($modelClass)) {
            abort(404, 'Model not found');
        }

        $pageInstance = $modelClass::where('slug', $item)->first();

        if (!$pageInstance) {
            abort(404, 'Page not found');
        }
        if (method_exists($pageInstance, 'posts')) {

            $posts = $pageInstance->posts()->where('status', 1)->paginate(30);
        } else {
            abort(404, 'Posts relation not found');
        }
        return view('front.page', compact('posts', 'pageInstance'));

    }

    public function new()
    {
        $posts = Post::where('status', 1)->orderBy("id", "desc")->paginate(30);
        return view('front.new', compact('posts'));
    }

    public function single($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $durationInISO8601 = $this->convertMinutesToISO8601($post->duration);
        $keywords = $post->keywords->pluck('name')->filter()->toArray();

        return view('front.single', compact('post', 'keywords',"durationInISO8601"));
    }
    private function convertMinutesToISO8601($minutes)
    {
        $interval = CarbonInterval::minutes($minutes);
        return $interval->spec();
    }
}
