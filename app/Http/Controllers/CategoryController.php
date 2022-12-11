<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_cate()
    {
        $cate = Category::withCount('books')->get();
        return view('admin.pages.category')->with('slug','Category')->with('cate', $cate);
    }

    /**
     * add a item of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_cate()
    {
        return view('admin.pages.add_cate')->with('slug','Add Category');
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
            'category-name' => 'required | max:255',
            'category-slug' => 'required | max:255' ,
            'category-status' => 'required',
        ]);
        $category = new Category();
        $category->category_name = $data['category-name'];
        $category->category_slug = $data['category-slug'];
        $category->category_status = $data['category-status'];

        
        $category->save();
        return redirect('/admin/category')->with('status','add category success');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('category')->where('category_id',$id)->delete();
        DB::table('books')->where('category_id',$id)->update(['category_id' => 1]);
        return redirect('/admin/category')->with('status','Delete category success');
    }
    public function online($id)
    {
        DB::table('category')->where('category_id',$id)->update(['category_status' => 0]);
        return redirect('/admin/category')->with('status','Online category success');
    }
    public function offline($id)
    {
        DB::table('category')->where('category_id',$id)->update(['category_status' => 1]);
        return redirect('/admin/category')->with('status','Offline category success');
    }



    // ------ CUS CATEGORY --------- //


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_category()
    {
        $user_id = Auth::user()->id;
        // $user = DB::table('users')->join('images', 'images.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->where('role_id','=',1)->first();
        $image = DB::table('images')->where('user_id', '=', $user_id)->where('role_id', '=', 2)->first();
        if($image) {

        } else {
            $image = DB::table('images')->where('user_id', '=', 0)->where('role_id', '=', 1)->first();
        }
        $cate = Category::with('books')->get();
        return view('cus.pages.all_category')->with('slug','Category')->with('cate', $cate)->with('user',$image);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_category_slug($slug_cate)
    { 
        $user_id = Auth::user()->id;
        // $user = DB::table('users')->join('images', 'images.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->where('role_id','=',1)->first();
        $image = DB::table('images')->where('user_id', '=', $user_id)->where('role_id', '=', 2)->first();
        if($image) {

        } else {
            $image = DB::table('images')->where('user_id', '=', 0)->where('role_id', '=', 1)->first();
        }

        $cate = Category::with('books')->get();
        return view('cus.pages.all_category')->with('slug','Category')->with('cate', $cate)->with('slug_category', $slug_cate)->with('user',$image);
    }
}

