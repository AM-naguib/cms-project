<?php

namespace App\Http\Controllers\Dash;

use Validator;
use App\Models\Year;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $years = Year::orderBy("id", "desc")->get();
        return view("dashboard.years.index", compact("years"));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            "name" => "required|integer|min:3|unique:years,name",
        ]);

        if ($validated->fails()) {
            return response($validated->errors(), 400);
        }
        Year::create([
            "name" => $request->name,
            "slug" => Str::slug($request->name),
        ]);

        return response("Success", 200);
    }

    public function show(Year $year)
    {

        return response()->json($year, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Year $year)
    {

        $validated = Validator::make($request->all(), [
            "name" => "required|integer|min:3|unique:years,name," . $year->id,
        ]);

        if ($validated->fails()) {
            return response($validated->errors(), 400);
        }

        $year->update([
            "name" => $request->name,
            "slug" => Str::slug($request->name),
        ]);
        return response("Success", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Year $year)
    {
        $year->delete();
        return response("Success Deleted", 200);

    }
}
