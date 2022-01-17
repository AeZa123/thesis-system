<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Thesis;
use App\Models\User;

class SearchController extends Controller
{
    public function index(){

        return view('search');
    }

    public function search(Request $request){


        if($request->year == null){
            $request->validate([
                'search' => 'required',
            ]);
        }



        $name = $request->search;

        //year 1 เลือกปี ผ่าน
        //year 2 เลือกระหว่างปี - ปี ผ่าน

        //year = 3 คีย์เวิร์ด  ผ่าน
        //year = 4 ชื่อนักศึกษา




            if($request->year == '1'){

                $theses = DB::table('theses')
                            ->whereYear('updated_at', $request->year1)
                            ->where('status', '=', 1)
                            ->distinct()
                            ->get();
                return view('search2', compact('theses', 'name'));



            }elseif($request->year == '2'){

                $from = $request->year2;
                $to = $request->year3;
                $theses = Thesis::whereBetween('updated_at', [$from.'-01-01 00:00:00',$to.'-12-30 23:59:59'])
                                    ->where('status', '=', 1)
                                    ->distinct()
                                    ->get();
                return view('search2', compact('theses', 'name'));


            }elseif($request->year == '3'){

                $theses = DB::table('theses')
                            ->Where('theses.words_search', 'LIKE', '%'.$name.'%')
                            ->where('theses.status', '=', 1)
                            ->distinct()
                            ->get();

                return view('search2', compact('theses', 'name'));

            }elseif($request->year == '4'){
                //dd($request->year);
                $theses = DB::table('theses')
                        ->join('users_theses', 'theses.id', '=', 'users_theses.theses_id')
                        ->join('users', 'users_theses.users_id', '=', 'users.id')
                        ->Where('users.name', 'LIKE', '%'.$name.'%')
                        ->where('theses.status', '=', 1)
                        ->select('theses.id', 'theses.title', 'theses.description', 'theses.img')
                        ->distinct()
                        ->get();

                if(empty($theses)){
                    dd($theses);
                    return back();
                }


                return view('search2', compact('theses', 'name'));

            }

            //ใช้ ดิสติง ในการทำให้ไม่ซ้ำ

            $theses = DB::table('theses')
                        ->join('users_theses', 'theses.id', '=', 'users_theses.theses_id')
                        ->join('users', 'users_theses.users_id', '=', 'users.id')
                        ->Where('theses.title', 'LIKE', '%'.$name.'%')
                        ->orWhere('theses.words_search', 'LIKE', '%'.$name.'%')
                        ->orWhere('users.name', 'LIKE', '%'.$name.'%')
                        ->where('theses.status', '=', 1)
                        ->select('theses.id', 'theses.title', 'theses.description', 'theses.img')
                        ->distinct()
                        ->get();


                $num = DB::table('notifications')
                        ->where('users_id',Auth::user()->id)
                        ->get();

                $count = count($num);
                    if($count == 0){
                        $count = NULL;
                }



                User::find(Auth::user()->id)->update([

                    'notification' => $count,
                ]);



            return view('search2', compact('theses', 'name'));



    }
}
