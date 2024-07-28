<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view("dashboard.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|min:3|unique:categories,name",
            "slug" => "required|string|min:3|unique:categories,slug",
        ]);
        $data["slug"] = preg_replace('/^-+|-+$/', '', preg_replace('/\s+/', '-', $request->name));
        Category::create($data);
        toastr()->success('Category Created Successfully');
        return redirect()->route("dashboard.categories.index");
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view("dashboard.categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            "name" => "required|string|min:3|unique:categories,name," . $category->id,
            "slug" => "required|string|min:3|unique:categories,slug," . $category->id,
        ]);
        $data["slug"] = preg_replace('/^-+|-+$/', '', preg_replace('/\s+/', '-', $request->name));
        $category->update($data);
        toastr()->success('Category Updated Successfully');
        return redirect()->route("dashboard.categories.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        if(auth()->user()){
            $category->delete();
            return response("Success Deleted", 200);
        }
        return response("Unauthorized", 401);
    }

}
