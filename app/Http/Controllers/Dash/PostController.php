<?php

namespace App\Http\Controllers\Dash;

use App\Models\Post;
use App\Models\Year;
use App\Models\Keyword;
use App\Models\Quality;
use App\Models\Category;
use App\Models\MainName;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard.posts.index", compact("categories"));
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

        return view("dashboard.posts.create", compact("categories","main_name","qualities","keywords"));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       dd($request->all());
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
