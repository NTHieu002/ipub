<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $user_id = Auth::user()->id;
        // $user = DB::table('users')->join('images', 'images.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->where('role_id','=',1)->first();
        $image = DB::table('images')->where('user_id', '=', $user_id)->where('role_id', '=', 2)->first();
        if($image) {

        } else {
            $image = DB::table('images')->where('user_id', '=', 0)->where('role_id', '=', 1)->first();
        }
        $books = Books::where('book_status', 0)->limit(12)->get();
        $category = Category::where('category_status',0)->get();
        $banner = Banner::where('role_id', 0)->where('banner_status', 0)->limit(3)->get();
        return view('home')->with('books', $books)->with('cate', $category)->with('banner',$banner)->with('user',$image);
    }
    public function search() {
        $key = $_GET['key'];
        $books = Books::where('book_status', 0)->where('book_name','LIKE', '%'.$key.'%')->get();
        $category = Category::where('category_status',0)->get();
        $banner = Banner::where('role_id', 0)->where('banner_status', 0)->limit(3)->get();
        return view('cus.pages.search')->with('books', $books)->with('cate', $category)->with('banner',$banner)->with('key',$key);
    }

    public  function profile($user_id) 
    {
        $user = DB::table('users')->join('images', 'images.user_id', '=','users.id')->where('users.id', '=', $user_id)->where('role_id','=',2)->first();
        $image = DB::table('images')->where('user_id', '=', $user_id)->where('role_id', '=', 2)->first();
        if($image) {
            $category = Category::where('category_status',0)->get();
            return view('cus.pages.profile')->with('cate', $category)->with('user',$user);
        } else {
            $user = DB::table('images')->where('role_id','=',1)->where('user_id','=',0)->first();
            $category = Category::where('category_status',0)->get();
            return view('cus.pages.profile')->with('cate', $category)->with('user',$user);
        }

    }

    public  function store_profile(Request $request ,$user_id) 
    {
        $data = $request->validate([
            'user_name' => 'required | max:255',
            'role_id' => 'required',
        ]);
        $role = $data['role_id'];
        if($role == 1) {
            $image = new Banner();
        } else {
            $image = Banner::where('user_id','=',$user_id)->where('role_id','=',2)->first();
        }
        $image->role_id = 2;
        $image->banner_status = 0;
        $image->user_id = $user_id;

        $path_img = 'public/images';
        $get_image = $request->user_avt;
        $get_name_img = $get_image->getClientOriginalName();
        $name_img = current(explode('.',$get_name_img));
        $new_img = $name_img.rand(0,99). '.' .$get_image->getClientOriginalExtension();
        $get_image->move($path_img,$new_img);

        $image->image = $new_img;
        $image->save();
        $user = DB::table('users')->join('images', 'images.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->where('role_id','=',2)->first();
        $category = Category::where('category_status',0)->get();
        return view('cus.pages.profile')->with('cate', $category)->with('user',$user)->with('status','update success');
    }
}
