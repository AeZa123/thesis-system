<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\models\Thesis;
use App\models\User;
use App\models\UsersThesis;
use App\models\notification;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Runner\AfterTestFailureHook;

class ThesisController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */




    public function index()
    {

        $datas = DB::table('theses')
            ->select('theses.*')
            ->get();



        return view('ManageThesis.index-thesis', compact('datas'));
    }

    public function shows()
    {

        //$data = DB::table('theses')

        return view('ManageThesis.showts');
    }

    public function create()
    {

        $datas = DB::table('users')
            ->join('statuses', 'users.status_id', '=', 'statuses.id')
            ->where('users.status_id', '=', '2')
            ->select('users.*')
            ->get();

        $users = DB::table('users')
            ->join('statuses', 'users.status_id', '=', 'statuses.id')
            ->where('users.status_id', '=', '3')
            ->select('users.*')
            ->get();
            //dd($users);

        return view('ManageThesis.create-thesis', compact('datas', 'users'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'words_search' => 'required',
            'file_thesis' => 'required',
            'img' => 'required',
            'advisor_1' => 'required',
            'author_1' => 'required',
        ]);

        //dd($request, );


        //add and update theses
        if ($request->file('img') and $request->file('file_thesis')) {

            $photo = $request->file('img'); // img = ชื่อ name ใน input
            $photoname = time() . '.' . $photo->getClientOriginalExtension();
            $request->img->move('storage/img/thesis', $photoname); // img = 'img' ตัวนี้

            $file = $request->file('file_thesis'); // img = ชื่อ name ใน input
            $file_thesis = time() . '.' . $file->getClientOriginalExtension();
            $request->file_thesis->move('storage/file/thesis', $file_thesis); // img = 'img' ตัวนี้


            $data = new Thesis;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->words_search = $request->words_search;
            $data->file_thesis = $file_thesis;
            $data->img = $photoname;
            $data->save();

            $thesis_id = DB::table('theses')
                            ->where('title',$request->title)
                            ->select('id')
                            ->first();

            $users_id = DB::table('users')
                        ->whereIn('name',
                            [
                                $request->advisor_1,
                                $request->advisor_2,
                                $request->author_1,
                                $request->author_2,
                                $request->author_3,
                            ])
                        ->get();


            for($i = 0; $i < count($users_id); $i++){

                $add_users_theses = new UsersThesis;
                $add_users_theses->users_id = $users_id[$i]->id;
                $add_users_theses->theses_id = $thesis_id->id;
                $add_users_theses->save();

            }

           $id_advisor = DB::table('users')
                            ->whereIn('name', [
                                $request->advisor_1,
                                $request->advisor_2,
                            ])
                            ->get();

            for($k=0; $k<count($id_advisor); $k++){

                $notification = new notification;
                $notification->title = 'อัพเล่มปริญญานิพนธ์';
                $notification->description = Auth::user()->name .' ได้อัพโหลดไฟล์ปริญญานิพนธ์เรื่อง: '. $request->title;
                $notification->users_id = $id_advisor[$k]->id;
                $notification->thesis_id = $thesis_id->id;
                $notification->save();

            }


        }

        if(Auth::user()->status_id == 3){
            return redirect()->route('show-notification')->with('success', 'เพิ่มข้อมูลปริญญานิพนธ์เสร็จเรียบร้อย รอให้อาจารย์ตรวจจะแจ้งให้ทราบครับ.');
        }

        return redirect()->route('theses')->with('success', 'เพิ่มข้อมูลเสร็จเรียบร้อย');
    }

    public function edit($id)
    {

        $id_users = UsersThesis::select('users_id')  //เอา users_id ที่ตรงกับ thesis_id ออกมา
            ->where('theses_id', '=', $id)
            ->get();

        $name_user = array();
        for($i = 0; $i < count($id_users); $i++){

            $users_theses_id = UsersThesis::select('id', 'users_id')
                ->where('theses_id', $id)
                ->where('users_id', $id_users[$i]->users_id)
                ->first();

            $name = User::find($users_theses_id->users_id);

            array_push($name_user, $name);

        }

        $name_advisor = array();
        $name_student = array();
        for($j = 0; $j < count($name_user); $j++){

            if($name_user[$j]->status_id == '2'){

                array_push($name_advisor, $name_user[$j]);

            }elseif($name_user[$j]->status_id == '3'){

                array_push($name_student, $name_user[$j]);
            }

        }


        $advisors = DB::table('users')
            ->join('statuses', 'users.status_id', '=', 'statuses.id')
            ->where('users.status_id', '=', '2')
            ->select('users.*')
            ->get();

        $users = DB::table('users')
            ->join('statuses', 'users.status_id', '=', 'statuses.id')
            ->where('users.status_id', '=', '3')
            ->select('users.*')
            ->get();

        $data = Thesis::find($id);

        return view('ManageThesis.edit-thesis', compact('data', 'advisors', 'users', 'name_student', 'name_advisor'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'words_search' => 'required',
            'advisor_1' => 'required',
            'author_1' => 'required',
        ]);


        if ($request->file('file_thesis') and $request->file('img')) {

            $photo = $request->file('img'); // img = ชื่อ name ใน input
            $photoname = time() . '.' . $photo->getClientOriginalExtension();
            $request->img->move('storage/img/thesis', $photoname); // img = 'img' ตัวนี้

            $file = $request->file('file_thesis'); // img = ชื่อ name ใน input
            $file_thesis = time() . '.' . $file->getClientOriginalExtension();
            $request->file_thesis->move('storage/file/thesis', $file_thesis); // img = 'img' ตัวนี้

            $thesis_id = $request->thesis_id;
            Thesis::updateOrCreate(
                ['id'      => $thesis_id],
                [
                    'title'    => $request->title,
                    'description'    => $request->description,
                    'words_search'    => $request->words_search,
                    'img'      => $photoname,
                    'file_thesis'      => $file_thesis,
                    'status' => $request->check,
                ]
            );
        }else{

            Thesis::find($request->thesis_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'words_search' => $request->words_search,
                'status' => $request->check,
            ]);

        }

        $thesis_id = $request->thesis_id;
        $users_id = array();

        if($request->advisor_1 != 'select'){
            $data_advisor_1 = User::where('name', '=', $request->advisor_1)
            ->select('users.id')->first();
            array_push($users_id, $data_advisor_1->id);
        }else{
            $data_advisor_1 = 'null';
        }

        if($request->advisor_2 != 'select'){
            $data_advisor_2 = User::where('name', '=', $request->advisor_2)
            ->select('users.id')->first();
            array_push($users_id, $data_advisor_2->id);
        }else{
            $data_advisor_2 = 'null';
        }

        if($request->author_1 != 'select'){
            $data_author_1 = User::where('name', '=', $request->author_1)
            ->select('users.id')->first();
            array_push($users_id, $data_author_1->id);
        }else{
            $data_author_1 = 'null';
        }

        if($request->author_2 != 'select'){
            $data_author_2 = User::where('name', '=', $request->author_2)
            ->select('users.id')->first();
            array_push($users_id, $data_author_2->id);
        }else{
            $data_author_2 = 'null';
        }

        if($request->author_3 != 'select'){
            $data_author_3 = User::where('name', '=', $request->author_3)
            ->select('users.id')->first();
            array_push($users_id, $data_author_3->id);
        }else{
            $data_author_3 = 'null';
        }



        //dd($data_advisor_1->id, $data_advisor_2->id, $data_author_1->id, $data_author_2->id, $data_author_3->id);

        UsersThesis::select('id')  //ลบ row ที่ตรงกับ thesis_id ทั้งหมด
                ->where('theses_id', '=', $request->thesis_id)
                ->delete();


        for($i=0; $i<count($users_id); $i++){

            $data = new UsersThesis;
            $data->users_id = $users_id[$i];
            $data->theses_id = $request->thesis_id;
            $data->save();

        }


        return redirect()->route('theses')->with('success', 'แก้ไขข้อมูลสำเร็จ');
    }


    public function delete(Request $request)
    {

        //delete file thesis
        $data = Thesis::find($request->id);
        $file_name = $data->file_thesis;
        unlink('storage/file/thesis/'.$file_name);

        //delete file photo thesis
        $data = Thesis::find($request->id);
        $file_name = $data->img;
        unlink('storage/img/thesis/'.$file_name);
        $data->delete();

        //delete user and thesis on table users_theses
        $data = UsersThesis::select('id')
                ->where('theses_id', '=', $request->id)
                ->delete();

        return redirect()->route('theses')->with('success', 'ลบข้อมูลเรียบร้อย');
    }


    public function showThesis($id)
    {


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

        return view('ManageThesis.showts', compact('data', 'teachers', 'students'));
    }


    public function CheckStatusThesis(Request $request){



        $users_id = DB::table('users_theses')
                    ->join('users', 'users_theses.users_id', '=', 'users.id')
                    ->where('users_theses.theses_id', $request->thesis_id)
                    ->where('users.status_id', 3)
                    ->get();

        //dd($request, $users_id);

        if($request->check == 'ผ่าน'){

            Thesis::find($request->thesis_id)->update([
                'status' => 1,
            ]);

            for($i=0; $i<count($users_id); $i++){

                $new = new notification;
                $new->title = 'ตรวจเล่ม';
                $new->description = 'เล่มของคุณได้ผ่านเป็นที่เรียบร้อยแล้ว';
                $new->users_id = $users_id[$i]->id;
                $new->groups_id = NULL;
                $new->works_id = NULL;
                $new->thesis_id = $request->thesis_id;
                $new->save();


                $num = DB::table('notifications')
                    ->where('users_id',$users_id[$i]->id)
                    ->get();

                $count = count($num);
                    if($count == 0){
                        $count = NULL;
                    }

                User::find($users_id[$i]->id)->update([

                    'notification' => $count,
                ]);



            }//for


        }elseif($request->check == 'ไม่ผ่าน'){

            Thesis::find($request->thesis_id)->update([
                'status' => 0,
            ]);


            for($j=0; $j<count($users_id); $j++){

                if($request->comment != null){
                    $new = new notification;
                    $new->title = 'ตรวจเล่ม';
                    $new->description = 'เล่มของคุณไม่ผ่านเนื่องจาก'. $request->comment .'กรุณาแก้ไขแล้วอัพโหลดใหม่';
                    $new->users_id = $users_id[$j]->id;
                    $new->groups_id = NULL;
                    $new->works_id = NULL;
                    $new->thesis_id = $request->thesis_id;
                    $new->save();

                    $num = DB::table('notifications')
                        ->where('users_id',$users_id[$j]->id)
                        ->get();

                    $count = count($num);
                        if($count == 0){
                            $count = NULL;
                        }

                    User::find($users_id[$j]->id)->update([

                        'notification' => $count,
                    ]);


                }else{
                    $new = new notification;
                    $new->title = 'ตรวจเล่ม';
                    $new->description = 'เล่มของคุณไม่ผ่าน กรุณาแก้ไขและอัพโหลดใหม่';
                    $new->users_id = $users_id[$j]->id;
                    $new->groups_id = NULL;
                    $new->works_id = NULL;
                    $new->thesis_id = $request->thesis_id;
                    $new->save();


                    $num = DB::table('notifications')
                        ->where('users_id',$users_id[$j]->id)
                        ->get();

                    $count = count($num);
                        if($count == 0){
                            $count = NULL;
                        }

                    User::find($users_id[$j]->id)->update([

                        'notification' => $count,
                    ]);


                }

            }//for

            //delete file thesis
            $data = Thesis::find($request->thesis_id);
            $file_name = $data->file_thesis;
            unlink('storage/file/thesis/'.$file_name);

            //delete file photo thesis
            $data = Thesis::find($request->thesis_id);
            $file_name = $data->img;
            unlink('storage/img/thesis/'.$file_name);
            $data->delete();

            //delete user and thesis on table users_theses
            $data = UsersThesis::select('id')
                    ->where('theses_id', '=', $request->thesis_id)
                    ->delete();

        }//elseif


        DB::table('notifications')
            ->where('thesis_id', $request->thesis_id)
            ->where('users_id', Auth::user()->id)
            ->delete();


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


        return redirect()->route('show-notification');


    }


}
