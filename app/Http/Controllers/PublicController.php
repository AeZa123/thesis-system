<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Thesis;

class PublicController extends Controller
{

    public function search(Request $request){


        if($request->year == null){
            $request->validate([
                'search' => 'required',
            ]);
        }



        $name = $request->search;

        //year 1 เลือกปี
        //year 2 เลือกระหว่างปี - ปี

        //year = 3 คีย์เวิร์ด
        //year = 4 ชื่อนักศึกษา




            if($request->year == '1'){

                $theses = DB::table('theses')
                            ->whereYear('updated_at', $request->year1)
                            ->distinct()
                            ->get();

                return view('index01', compact('theses', 'name'));



            }elseif($request->year == '2'){

                $from = $request->year2;
                $to = $request->year3;
                $theses = Thesis::whereBetween('updated_at', [$from.'-01-01 00:00:00',$to.'-12-30 23:59:59'])
                                    ->distinct()
                                    ->get();
                                    //dd($theses);
                return view('index01', compact('theses', 'name'));


            }elseif($request->year == '3'){

                $theses = DB::table('theses')
                            ->Where('theses.words_search', 'LIKE', '%'.$name.'%')
                            ->distinct()
                            ->get();

                return view('index01', compact('theses', 'name'));

            }elseif($request->year == '4'){

                $theses = DB::table('theses')
                        ->join('users_theses', 'theses.id', '=', 'users_theses.theses_id')
                        ->join('users', 'users_theses.users_id', '=', 'users.id')
                        ->orWhere('users.name', 'LIKE', '%'.$name.'%')
                        ->distinct()
                        ->get();
                //dd($theses);
                return view('index01', compact('theses', 'name'));


            }

            //ใช้ ดิสติง ในการทำให้ไม่ซ้ำ

            $theses = DB::table('theses')
                        ->join('users_theses', 'theses.id', '=', 'users_theses.theses_id')
                        ->join('users', 'users_theses.users_id', '=', 'users.id')
                        ->where('theses.status', '=', 1)
                        ->Where('theses.title', 'LIKE', '%'.$name.'%')
                        ->orWhere('theses.words_search', 'LIKE', '%'.$name.'%')
                        ->orWhere('users.name', 'LIKE', '%'.$name.'%')
                        ->select('theses.id', 'theses.title', 'theses.description', 'theses.img')
                        ->distinct()
                        ->get();

            return view('index01', compact('theses', 'name'));
    }


    public function showThesis($id){


        $data = Thesis::find($id);

        $teachers = DB::table('users')
            ->join('users_theses', 'users.id', '=', 'users_theses.users_id')
            ->where('theses_id', '=', $id)
            ->where('status_id', '=', '2')
            ->select('users_theses.users_id', 'users.name')
            ->get();

        $students = DB::table('users')
            ->join('users_theses', 'users.id', '=', 'users_theses.users_id')
            ->where('theses_id', '=', $id)
            ->where('status_id', '=', '3')
            ->select('users_theses.users_id', 'users.name')
            ->get();



            //dd($data, $teachers, $students);

        return view('public.show-thesis', compact('data', 'teachers', 'students'));
    }

    public function topdownload(){

        $count = DB::table('downloads')
            ->select('theses_id',DB::raw('count(theses_id) AS count_id'))
            ->groupBy('theses_id')
            ->get();


        if(empty($count[0])){

            $count = null;
            return view('public.top-download', compact('count'));
        }



        $datas = DB::table('theses')
                ->whereIn('theses.id', [$count[0]->theses_id, $count[1]->theses_id, $count[2]->theses_id])
                ->get();



        //dd($datas, $count);
        return view('public.top-download', compact('datas','count'));

    }





}
