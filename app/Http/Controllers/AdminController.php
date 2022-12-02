<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function dashboard() {
        return view('admin.pages.dashboard')->with('slug','dashboard');;
    }

    public function profile () {
        return view('admin.pages.profile')->with('slug','profile');
    }

    public function books () {
        return view('admin.pages.books')->with('slug','books');;
    }

    public function accessory () {
        $cate = Category::all();
        return view('admin.pages.accessory')->with('slug','Accessory')->with('cate', $cate);
    }

  
}
