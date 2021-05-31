<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Thesis;



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

        $member = User::count();
        $thesis = Thesis::count();
        $download = Download::count();
        $group = Group::count();

        //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
        $all_notification5 = DB::table('notifications')
            ->where('users_id', Auth::user()->id)
            ->get();

        //นับว่ามีกี่รายการ
        $count_notification5 = count($all_notification5);


        if($count_notification5 == 0){
            $count_notification5 = NULL;
        }


        //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
        User::find(Auth::user()->id)->update([
            'notification' => $count_notification5,
        ]);

        return view('home', compact('member', 'thesis', 'download', 'group'));
    }
}
