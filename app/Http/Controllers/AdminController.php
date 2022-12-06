<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Banner;
use App\Models\Visitor;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{

    // // Function to get the client IP address
    // function get_client_ip() {
    //     $ipaddress = '';
    //     if (getenv('HTTP_CLIENT_IP'))
    //         $ipaddress = getenv('HTTP_CLIENT_IP');
    //     else if(getenv('HTTP_X_FORWARDED_FOR'))
    //         $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    //     else if(getenv('HTTP_X_FORWARDED'))
    //         $ipaddress = getenv('HTTP_X_FORWARDED');
    //     else if(getenv('HTTP_FORWARDED_FOR'))
    //         $ipaddress = getenv('HTTP_FORWARDED_FOR');
    //     else if(getenv('HTTP_FORWARDED'))
    //     $ipaddress = getenv('HTTP_FORWARDED');
    //     else if(getenv('REMOTE_ADDR'))
    //         $ipaddress = getenv('REMOTE_ADDR');
    //     else
    //         $ipaddress = 'UNKNOWN';
    //     return $ipaddress;
    // }
    public function dashboard(Request $request) {
        $user_ip_address = $_SERVER['REMOTE_ADDR'];
        $visit_tor_current = Visitor::where('ip_address', $user_ip_address)->get();
        $visitor_count = $visit_tor_current->count();
        if($visitor_count < 0) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip_address;
            $visitor->visit_date = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }
        $visitor = Visitor::all();
        $visitor_total = $visitor->count();


        $views = View::all();
        $total_view = 0;
        foreach($views as $view) {
            $total_view = $view->book_views + $total_view;
        }
        
        return view('admin.pages.dashboard')->with('slug','dashboard')->with('total_visit', $visitor_total)->with('online', $visitor_count)
        ->with('total_view', $total_view);
    }

    public function profile () {
        return view('admin.pages.profile')->with('slug','profile');
    }

    public function books () {
        $cate = Category::withCount('books')->get();
        return view('admin.pages.books')->with('slug','Books')->with('cate', $cate);
    }

    public function accessory () {
        $cate = Category::all();
        return view('admin.pages.accessory')->with('slug','Accessory')->with('cate', $cate);
    }

    
    public function banner() {
        $banners = Banner::where('role_id', 0)->get();
        return view('admin.pages.banner')->with('slug','Banner')->with('banners', $banners);
    }
    public function banner_upload() {
        return view('admin.pages.banner_upload')->with('slug','Banner Upload');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_banner(Request $request) {
        $data = $request->validate([
            'banner_img' => 'required ',
        ]);

        $banner = new Banner();
        $banner->role_id = 0;
        $banner->banner_status = 0;

        $path_img = 'public/uploads/images';
        $get_image = $request->banner_img;
        $get_name_img = $get_image->getClientOriginalName();
        $name_img = current(explode('.',$get_name_img));
        $new_img = $name_img.rand(0,99). '.' .$get_image->getClientOriginalExtension();
        $get_image->move($path_img,$new_img);

        $banner->image = $new_img;
        $banner->save();

        return redirect('/admin/banner')->with('slug','Banner')->with('status','Upload success');
    }
    
    public function online($id)
    {
        DB::table('images')->where('image_id',$id)->update(['banner_status' => 0]);
        return redirect('/admin/banner')->with('status','Online banner success');
    }
    public function offline($id)
    {
        DB::table('images')->where('image_id',$id)->update(['banner_status' => 1]);
        return redirect('/admin/banner')->with('status','Offline banner success');
    }
}
