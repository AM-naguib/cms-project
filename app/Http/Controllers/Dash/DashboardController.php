<?php

namespace App\Http\Controllers\Dash;

use App\Models\Post;
use App\Models\Year;
use App\Models\Genre;
use App\Models\Keyword;
use App\Models\Category;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $mainCategories = MainCategory::get()->count();
        $categories = Category::get()->count();
        $years = Year::get()->count();
        $genres = Genre::get()->count();
        $posts= Post::get()->count();
        $keywords = Keyword::get()->count();

        return view("dashboard.index")->with(get_defined_vars());
    }
}
