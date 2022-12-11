<?php

namespace App\Http\Controllers;

use App\Models\View;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookViewController extends Controller
{
    public function show_book($slug) {
        $user_id = Auth::user()->id;
        // $user = DB::table('users')->join('images', 'images.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->where('role_id','=',1)->first();
        $image = DB::table('images')->where('user_id', '=', $user_id)->where('role_id', '=', 2)->first();
        if($image) {

        } else {
            $image = DB::table('images')->where('user_id', '=', 0)->where('role_id', '=', 1)->first();
        }
        $books = Books::where('book_status', 0)->where("book_slug", $slug)->first();
        $category = Category::where('category_status',0)->get();
        $book_id = $books->id;
        $book_view = View::where('book_id',$book_id)->first();
        if($book_view) {
            $book_view->book_views = $book_view->book_views + 1;
        } else {
            $book_view = new View();
            $book_view->book_id = $book_id;
            $book_view->book_views = 1;
        }
        $book_view->save();
        return view('cus.pages.show_book')->with('book', $books)->with('cate', $category)->with('user',$image);
    }
}
