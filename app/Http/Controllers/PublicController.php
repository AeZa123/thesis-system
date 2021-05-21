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
                            ->whereYear('created_at', $request->year1)
                            //->distinct()
                            ->paginate(3);

                return view('public.index01', compact('theses', 'name'));



            }elseif($request->year == '2'){

                $from = $request->year2;
                $to = $request->year3;
                $theses = Thesis::whereBetween('created_at', [$from.'-01-01 00:00:00',$to.'-12-30 23:59:59'])
                                    ->distinct()
                                    ->paginate(3);

                return view('public.index01', compact('theses', 'name'));


            }elseif($request->year == '3'){

                $theses = DB::table('theses')
                            ->Where('theses.words_search', 'LIKE', '%'.$name.'%')
                            ->distinct()
                            ->paginate(3);

                return view('public.index01', compact('theses', 'name'));

            }elseif($request->year == '4'){

                $theses = DB::table('theses')
                        ->join('users_theses', 'theses.id', '=', 'users_theses.theses_id')
                        ->join('users', 'users_theses.users_id', '=', 'users.id')
                        ->orWhere('users.name', 'LIKE', '%'.$name.'%')
                        ->distinct()
                        ->paginate(3);

                return view('public.index01', compact('theses', 'name'));


            }

            //ใช้ ดิสติง ในการทำให้ไม่ซ้ำ

            $theses = DB::table('theses')
                        ->join('users_theses', 'theses.id', '=', 'users_theses.theses_id')
                        ->join('users', 'users_theses.users_id', '=', 'users.id')
                        ->Where('theses.title', 'LIKE', '%'.$name.'%')
                        ->orWhere('theses.words_search', 'LIKE', '%'.$name.'%')
                        ->orWhere('users.name', 'LIKE', '%'.$name.'%')
                        ->select('theses.id', 'theses.title', 'theses.description', 'theses.img')
                        ->distinct()
                        ->paginate(3);
            return view('public.index01', compact('theses', 'name'));
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

    public function TopDownload(){

        return view('public.top-download');

    }


    public function download(){



    }


}