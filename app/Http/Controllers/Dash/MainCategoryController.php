<?php

namespace App\Http\Controllers\Dash;

use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainCategories = MainCategory::orderBy("id", "desc")->get();
        return view("dashboard.main_categories.index", compact("mainCategories"));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|min:3|unique:main_categories,name",
        ]);
        MainCategory::create([
            "name" => $data["name"],
            "slug" => Str::slug($data["name"]),
        ]);
        return response("Success", 200);
    }



    public function show(MainCategory $mainCategory)
    {
        return response()->json($mainCategory, 200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MainCategory $mainCategory)
    {
        $data = $request->validate([
            "name" => "required|string|min:3|unique:main_categories,name," . $mainCategory->id,
        ]);
        $mainCategory->update([
            "name" => $data["name"],
            "slug" => Str::slug($data["name"]),
        ]);
        return response("Success", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MainCategory $mainCategory)
    {

        if (auth()->user()) {
            $mainCategory->delete();
            return response("Success Deleted", 200);
        }
        return response("Unauthorized", 401);
    }
}
