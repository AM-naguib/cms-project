<?php

namespace App\Http\Controllers\Dash;

use Validator;
use App\Models\Year;
use App\Models\Genre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::orderBy("id", "desc")->get();
        return view("dashboard.genres.index", compact("genres"));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|string|unique:genres,name",
        ]);

        if ($validated->fails()) {
            return response($validated->errors(), 400);
        }
        Genre::create([
            "name" => $request->name,
            "slug" =>  Str::slug($request->name) ,
        ]);

        return response("Success", 200);
    }

    public function show(Genre $genre)
    {

        return response($genre, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {

        $validated = Validator::make($request->all(), [
            "name" => "required|string|unique:genres,name," . $genre->id,
        ]);

        if ($validated->fails()) {
            return response($validated->errors(), 400);
        }

        $genre->update([
            "name" => $request->name,
            "slug" =>  Str::slug($request->name) ,
        ]);
        return response("Success", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return response("Success Deleted", 200);

    }
}
