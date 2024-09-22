<?php

namespace App\Http\Controllers\Dash;

use Validator;
use App\Models\Year;
use App\Models\Keyword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keywords = Keyword::orderBy("id", "desc")->get();
        return view("dashboard.keywords.index", compact("keywords"));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|string|unique:keywords,name",
        ]);

        if ($validated->fails()) {
            return response($validated->errors(), 400);
        }
        Keyword::create([
            "name" => $request->name,
            "slug" =>  Str::slug($request->name) ,
        ]);

        return response("Success", 200);
    }

    public function show(Keyword $keyword)
    {

        return response($keyword, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keyword $keyword)
    {

        $validated = Validator::make($request->all(), [
            "name" => "required|string|unique:keywords,name," . $keyword->id,
        ]);

        if ($validated->fails()) {
            return response($validated->errors(), 400);
        }

        $keyword->update([
            "name" => $request->name,
            "slug" =>  Str::slug($request->name) ,
        ]);
        return response("Success", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keyword $keyword)
    {
        $keyword->delete();
        return response("Success Deleted", 200);

    }
}
