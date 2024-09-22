<?php

namespace App\Http\Controllers\Dash;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy("id", "desc")->get();
        $mainCategories = MainCategory::select("id", "name")->get();
        return view("dashboard.categories.index", compact("categories", "mainCategories"));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|min:3|unique:categories,name",
            "main_category_id" => "required|exists:main_categories,id",
        ]);
        Category::create([
            "name" => $data["name"],
            "slug" => Str::slug($data["name"]),
            "main_category_id" => $data["main_category_id"],
        ]);

        return response("Success", 200);
    }



    public function show(Category $category){

        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            "name" => "required|string|min:3|unique:categories,name," . $category->id,
            "main_category_id" => "required|exists:main_categories,id",
        ]);
        $category->update([
            "name" => $data["name"],
            "slug" => Str::slug($data["name"]),
            "main_category_id" => $data["main_category_id"],
        ]);

        return response("Success", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {


            $category->delete();
            return response("Success Deleted", 200);

    }



}
