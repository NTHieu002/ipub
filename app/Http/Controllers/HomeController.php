<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = Books::where('book_status', 0)->limit(12)->get();
        $category = Category::where('category_status',0)->get();
        $banner = Banner::where('role_id', 0)->where('banner_status', 0)->limit(3)->get();
        return view('home')->with('books', $books)->with('cate', $category)->with('banner',$banner);
    }
    public function search() {
        $key = $_GET['key'];
        $books = Books::where('book_status', 0)->where('book_name','LIKE', '%'.$key.'%')->get();
        $category = Category::where('category_status',0)->get();
        $banner = Banner::where('role_id', 0)->where('banner_status', 0)->limit(3)->get();
        return view('cus.pages.search')->with('books', $books)->with('cate', $category)->with('banner',$banner)->with('key',$key);
    }
}
