<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Category;

class BookViewController extends Controller
{
    public function show_book($slug) {
        $books = Books::where('book_status', 0)->where("book_slug", $slug)->first();
        $category = Category::where('category_status',0)->get();
        return view('cus.pages.show_book')->with('book', $books)->with('cate', $category);
    }
}
