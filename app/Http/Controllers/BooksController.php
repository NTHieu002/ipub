<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Books;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'book-name' => 'required | max:255',
            'book-category' => 'required ' ,
            'book-desc' => 'required' ,
            'book' => 'required ',
            'book-slug' => 'required | max:255' ,
            'book-status' => 'required',
        ]);
        $book = new Books();
        $book->book_name = $data['book-name'];
        $book->book_desc = $data['book-desc'];
        $book->book_slug = $data['book-slug'];
        $book->book_status = $data['book-status'];
        $book->category_id = $data['book-category'];

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
        return redirect()->back()->with('status','upload success');
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
        $cate = Category::all();
        $book = Books::find($id);
        return view('admin.pages.edit_book')->with('book', $book)->with('cate', $cate)->with('slug','Edit book');
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
        DB::table('books')->where('id',$id)->delete();
        return redirect('/admin/books')->with('status','Delete books success');
    }
    
    public function online($id)
    {
        DB::table('books')->where('id',$id)->update(['book_status' => 0]);
        return redirect('/admin/books')->with('status','Online books success');
    }
    public function offline($id)
    {
        DB::table('books')->where('id',$id)->update(['book_status' => 1]);
        return redirect('/admin/books')->with('status','Offline books success');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_update(Request $request, $id)
    {
        $data = $request->validate([
            'book-name' => 'required | max:255',
            'book-category' => 'required ' ,
            'book-desc' => 'required' ,
            'book-slug' => 'required | max:255' ,
            'book-status' => 'required',
        ]);
        $book = Books::find($id);
        $book->book_name = $data['book-name'];
        $book->book_desc = $data['book-desc'];
        $book->book_slug = $data['book-slug'];
        $book->book_status = $data['book-status'];
        $book->category_id = $data['book-category'];

        // $path_img = 'public/uploads/images';
        // $get_image = $request->book_img;
        // $get_name_img = $get_image->getClientOriginalName();
        // $name_img = current(explode('.',$get_name_img));
        // $new_img = $name_img.rand(0,99). '.' .$get_image->getClientOriginalExtension();
        // $get_image->move($path_img,$new_img);
        
        
        // $path_book = 'public/uploads/books';
        // $get_book = $request->book;
        // $get_name_book = $get_book->getClientOriginalName();
        // $name_book = current(explode('.',$get_name_book));
        // $new_book = $name_book.rand(0,99). '.' .$get_book->getClientOriginalExtension();
        // $get_book->move($path_book,$new_book);
        
        
        // //$book->book_image = $new_img;
        // $book->book = $new_book;
        
        $book->save();
        return redirect('/admin/books/')->with('status','Update success');
    }

    

}
