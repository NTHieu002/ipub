<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Userlibrary;
use App\Models\Books;
use Faker\Provider\UserAgent;
use Illuminate\Support\Facades\DB;

class UserLibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $category = Category::where('category_status',0)->get();
        $user = User::where('id',$user_id)->first();
        $user_book = DB::table('books')->join('userlibrary','books.id','=','userlibrary.book_id')->where('userlibrary.user_id','=',$user_id)->get();
        return view('cus.userlibrary.userlibrary')->with('cate', $category)->with('user', $user)->with('user_book',$user_book);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {
        $data = $request->validate([
            'book-name' => 'required | max:255',
            'book' => 'required ',
            'book-slug' => 'required | max:255' ,
        ]);
        $book = new Books();
        $book->book_name = $data['book-name'];
        $book->book_desc =  $data['book-slug'];
        $book->book_slug = $data['book-slug'];
        $book->category_id = 1;
        $book->book_status = 0;

        // $path_img = 'public/uploads/images';
        // $get_image = $request->book_img;
        // $get_name_img = $get_image->getClientOriginalName();
        // $name_img = current(explode('.',$get_name_img));
        // $new_img = $name_img.rand(0,99). '.' .$get_image->getClientOriginalExtension();
        // $get_image->move($path_img,$new_img);
        
        
        $path_book = 'public/uploads/books';
        $get_book = $request->book;
        $get_name_book = $get_book->getClientOriginalName();
        $name_book = current(explode('.',$get_name_book));
        $new_book = $name_book.rand(0,99). '.' .$get_book->getClientOriginalExtension();
        $get_book->move($path_book,$new_book);
        
        
        //$book->book_image = $new_img;
        $book->book = $new_book;
        
        $book->save();
        
        $book_id = $book->id;
        $userlibrary = new Userlibrary();
        $userlibrary->book_id = $book_id;
        $userlibrary->user_id = $user_id;
        $userlibrary->save();

        
        return view('cus.userlibrary.userlibrary')->with('user_book',$user_book)->with('status','upload success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
