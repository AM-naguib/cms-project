<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::where('status', 1)->get();
        return view('front.index', compact('posts'));
    }
}
