<?php

namespace App\Http\Controllers;

use App\Models\View;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Category;

class BookViewController extends Controller
{
    public function show_book($slug) {
        $books = Books::where('book_status', 0)->where("book_slug", $slug)->first();
        $category = Category::where('category_status',0)->get();
        $book_id = $books->id;
        $book_view = View::where('book_id',$book_id)->first();
        $book_view->book_views = $book_view->book_views + 1;
        $book_view->save();
        return view('cus.pages.show_book')->with('book', $books)->with('cate', $category);
    }
}
