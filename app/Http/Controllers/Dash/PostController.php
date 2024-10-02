<?php

namespace App\Http\Controllers\Dash;

use App\Models\Post;
use App\Models\Year;
use App\Models\Genre;
use App\Models\Keyword;
use App\Models\Quality;
use App\Models\Category;
use App\Models\MainName;
use App\Models\KeywordPost;
use Illuminate\Support\Str;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Artisan;
use Intervention\Image\Drivers\Imagick\Driver;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy("id", "desc")->get();

        return view("dashboard.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select("id", "name")->get();
        $main_name = MainName::select("id", "name")->get();
        $qualities = Quality::select("id", "name")->get();
        $keywords = Keyword::select("id", "name")->get();
        $genres = Genre::select("id", "name")->get();

        return view("dashboard.posts.create", compact("categories", "main_name", "qualities", "keywords", "genres"));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            "title" => "required|string|min:3",
            "description" => "required|string|min:3",
            "watch_urls" => "required",
            "download_urls" => "required",
            'category' => 'required',
            'main_name' => 'required',
            "genres" => "nullable",
            "keywords" => "nullable",
            "quality" => "nullable",
            "year" => "nullable",
            "episode_number" => "nullable",
            'duration' => 'nullable',
            "status" => "nullable",
            "season" => "nullable",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);
        if ($request->hasFile("image")) {
            $directory = storage_path('app/public/uploads');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $img_name = hexdec(uniqid() . "") . "." . $request->file("image")->getClientOriginalExtension();
            $img = $manager->read($request->file("image"));
            $img->resize(231, 343);
            $img->toJpeg(80)->save($directory . "/" . $img_name);
            $url = "uploads/" . $img_name;
            $data["image_url"] = $url;
        }
        $getMainCategoryName = explode(" ", $request->category);
        $mainCategory = MainCategory::firstOrCreate(["name" => $getMainCategoryName[0], "slug" => Str::slug($getMainCategoryName[0])]);

        $category = Category::firstOrCreate(["name" => trim($request->category), "slug" => Str::slug($request->category), "main_category_id" => $mainCategory->id]);
        if ($request->quality != null) {
            $quality = Quality::firstOrCreate(["name" => trim($request->quality), "slug" => Str::slug($request->quality)]);
        }
        if ($request->year != null) {
            $year = Year::firstOrCreate(["name" => trim($request->year), "slug" => Str::slug($request->year)]);
        }
        if ($request->main_name != null) {
            $main_name = MainName::firstOrCreate(["name" => trim($request->main_name), "slug" => Str::slug($request->main_name)]);
        }

        $post = Post::create([
            "title" => $request->title,
            "slug" => Str::slug($request->title),
            "description" => $request->description,
            "watch_urls" => $request->watch_urls,
            "download_urls" => $request->download_urls,
            "category_id" => $category->id,
            "main_name_id" => $main_name->id,
            "quality_id" => $quality->id,
            "year_id" => $year->id,
            "episode_number" => $request->episode_number,
            "duration" => $request->duration,
            "status" => 1,
            "image_url" => $data["image_url"] ?? null,
        ]);


        if ($request->keywords == null) {
            $this->addDefaultKeywords($post);
        } else {
            foreach ($request->keywords as $keyword) {
                $keyword = Keyword::firstOrCreate(["name" => trim($keyword), "slug" => Str::slug($keyword)]);
                $post->keywords()->attach($keyword->id);
            }
        }

        foreach ($request->genres as $genre) {
            $genre = Genre::firstOrCreate(["name" => trim($genre), "slug" => Str::slug($genre)]);
            $post->genres()->attach($genre);
        }
        Artisan::call('sitemap:generate');
        toastr()->success('Post Created Successfully');
        return to_route("dashboard.posts.index");

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::select("id", "name")->get();
        $main_name = MainName::select("id", "name")->get();
        $qualities = Quality::select("id", "name")->get();
        $keywords = Keyword::select("id", "name")->get();
        $genres = Genre::select("id", "name")->get();
        return view("dashboard.posts.edit", compact("post", "categories", "main_name", "qualities", "keywords", "genres"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            "title" => "required|string|min:3",
            "description" => "required|string|min:3",
            "watch_urls" => "required",
            "download_urls" => "required",
            'category' => 'required',
            'main_name' => 'required',
            "genres" => "required",
            "keywords" => "required",
            "quality" => "required",
            "year" => "required",
            "episode_number" => "required",
            'duration' => 'required',
            "status" => "nullable",
            "season" => "nullable",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);
        if ($request->hasFile("image")) {
            $data["image_url"] = $request->file("image")->store("uploads", "public");

        }
        $category = Category::firstOrCreate(["name" => trim($request->category), "slug" => Str::slug($request->category)]);
        $quality = Quality::firstOrCreate(["name" => trim($request->quality), "slug" => Str::slug($request->quality)]);
        $year = Year::firstOrCreate(["name" => trim($request->year)]);
        $main_name = MainName::firstOrCreate(["name" => trim($request->main_name), "slug" => Str::slug($request->main_name)]);
        $post->update([
            "title" => $request->title,
            "slug" => Str::slug($request->title),
            "description" => $request->description,
            "watch_urls" => $request->watch_urls,
            "download_urls" => $request->download_urls,
            "category_id" => $category->id,
            "main_name_id" => $main_name->id,
            "quality_id" => $quality->id,
            "year_id" => $year->id,
            "episode_number" => $request->episode_number,
            "duration" => $request->duration,
            "status" => 1,
            "image_url" => $data["image_url"] ?? $post->image_url,
        ]);
        $post->keywords()->detach();
        $keywords = [];
        foreach ($request->keywords as $keyword) {
            $keyword_id = Keyword::find($keyword);
            if (!$keyword_id) {
                $keyword = Keyword::firstOrCreate(["name" => trim($keyword), "slug" => Str::slug($keyword)]);
                $keywords[] = $keyword->id;
            } else {
                $keywords[] = $keyword_id->id;
            }

        }

        $post->keywords()->attach($keywords);

        $post->genres()->detach();

        $genres = [];
        foreach ($request->genres as $genre) {
            $genre_id = Genre::find($genre);
            if (!$genre_id) {
                $genre = Genre::firstOrCreate(["name" => trim($genre), "slug" => Str::slug($genre)]);
                $genres[] = $genre->id;
            } else {
                $genres[] = $genre_id->id;
            }
        }
        $post->genres()->attach($genres);

        toastr()->success('Post Updated Successfully');
        return to_route("dashboard.posts.index");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response("Success Deleted", 200);
    }


    public function addDefaultKeywords(Post $post)
    {
        $keywords = [
            "مشاهدة $post->title",
            "تحميل $post->title",
            "مشاهده $post->title",
            getSettings()->site_title,
            $post->title
        ];
        $keywordIds = [];
        foreach ($keywords as $keyword) {
            $keyword_id = Keyword::find($keyword);
            if (!$keyword_id) {
                $keyword = Keyword::firstOrCreate(["name" => trim($keyword), "slug" => Str::slug($keyword)]);
                $keywordIds[] = $keyword->id;
            } else {
                $keywordIds[] = $keyword_id->id;
            }
        }
        $post->keywords()->attach($keywordIds);
        return $post->keywords;
    }
}
