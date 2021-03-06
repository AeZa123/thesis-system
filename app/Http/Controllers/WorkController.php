<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Group;
use App\Models\User;
use App\Models\notification;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
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





    public function createWork(Request $request){

        $data= $request->group_id;

        return view('Group.Work.create-work', compact('data'));
    }

    public function storage(Request $request){


        //dd($request);

        //ตั้งชื่อไฟล์ เพื่อไม่ให้เกิดการซ้ำ
        if($request->file('document1') and $request->file('document2')){




            $file1 = $request->file('document1'); // img = ชื่อ name ใน input
            $document1 = time() . '-' . $file1->getClientOriginalName();
            $request->document1->move('storage/file/works', $document1); // img = 'img' ตัวนี้

            $file2 = $request->file('document2'); // img = ชื่อ name ใน input
            $document2 = time() . '-' . $file2->getClientOriginalName();
            $request->document2->move('storage/file/works', $document2); // img = 'img' ตัวนี้


            $data = new Work;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->document1 = $document1;
            $data->document2 = $document2;
            $data->group_id = $request->group_id;
            $data->save();


            $data_group = Group::find($request->group_id);

            $work_id = DB::table('works')
                    ->where('title','LIKE', '%'.$request->title.'%' )
                    ->first();

            $user_id = DB::table('users')
                    ->where('group_id', $request->group_id)
                    ->get();

            for($i=0; $i<count($user_id); $i++){

                //เพิ่ม ข้อมูลลงใน table notifications
                $notification = new notification;
                $notification->title = 'สั่งงาน';
                $notification->description = Auth::user()->name .' ได้มอบหมายงาน';
                $notification->users_id = $user_id[$i]->id; // คนที่อยู่ในกลุ่ม
                $notification->groups_id = $request->group_id; //group_id
                $notification->works_id = $work_id->id; //group_id
                $notification->save();

            }


            for($j=0; $j<count($user_id); $j++){

                //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                $all_notification2 = DB::table('notifications')
                    ->where('users_id', $user_id[$j]->id)
                    ->count();


                 //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                User::find($user_id[$j]->id)->update([

                    'notification' => $all_notification2,
                ]);

            }



        }elseif($request->file('document1')){

            $file = $request->file('document1'); // img = ชื่อ name ใน input
            $document1 = time() . '.' . $file->getClientOriginalName();
            $request->document1->move('storage/file/works', $document1); // img = 'img' ตัวนี้

            $data = new Work;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->document1 = $document1;
            $data->group_id = $request->group_id;
            $data->save();


            $data_group = Group::find($request->group_id);

            $work_id = DB::table('works')
                    ->where('title','LIKE', '%'.$request->title.'%' )
                    ->first();

            $user_id = DB::table('users')
                    ->where('group_id', $request->group_id)
                    ->get();

            for($i=0; $i<count($user_id); $i++){

                //เพิ่ม ข้อมูลลงใน table notifications
                $notification = new notification;
                $notification->title = 'สั่งงาน';
                $notification->description = Auth::user()->name .' ได้มอบหมายงาน';
                $notification->users_id = $user_id[$i]->id; // คนที่อยู่ในกลุ่ม
                $notification->groups_id = $request->group_id; //group_id
                $notification->works_id = $work_id->id; //group_id
                $notification->save();

            }


            for($j=0; $j<count($user_id); $j++){

                //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                $all_notification2 = DB::table('notifications')
                    ->where('users_id', $user_id[$j]->id)
                    ->count();


                 //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                User::find($user_id[$j]->id)->update([

                    'notification' => $all_notification2,
                ]);

            }


        }else{

            $data = new Work;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->group_id = $request->group_id;
            $data->save();

            $data_group = Group::find($request->group_id);

            $work_id = DB::table('works')
                    ->where('title','LIKE', '%'.$request->title.'%' )
                    ->first();

            $user_id = DB::table('users')
                    ->where('group_id', $request->group_id)
                    ->get();

            for($i=0; $i<count($user_id); $i++){

                //เพิ่ม ข้อมูลลงใน table notifications
                $notification = new notification;
                $notification->title = 'สั่งงาน';
                $notification->description = Auth::user()->name .' ได้มอบหมายงาน';
                $notification->users_id = $user_id[$i]->id; // คนที่อยู่ในกลุ่ม
                $notification->groups_id = $request->group_id; //group_id
                $notification->works_id = $work_id->id; //group_id
                $notification->save();

            }


            for($j=0; $j<count($user_id); $j++){

                //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                $all_notification2 = DB::table('notifications')
                    ->where('users_id', $user_id[$j]->id)
                    ->count();


                 //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                User::find($user_id[$j]->id)->update([

                    'notification' => $all_notification2,
                ]);

            }

        }



        $id = $request->group_id;


        $data_nameGroup = Group::find($id)->name_group;


        $works = DB::table('works')
                        ->where('group_id', '=', $id)
                        ->select('works.title', 'works.id')
                        ->get();


        $students = DB::table('users')
                        ->where('group_id', '=', $id)
                        ->select('name')
                        ->get();

        //ดึงรายชื่อ อจ ที่อยู่ในกลุ่ม
        $advisor1 = DB::table('users')
                        ->join('groups', 'users.id', '=', 'groups.advisor_1')
                        ->where('groups.id', '=', $id)
                        ->select('users.name')
                        ->first();

        $advisor2 = DB::table('users')
                        ->join('groups', 'users.id', '=', 'groups.advisor_2')
                        ->where('groups.id', '=', $id)
                        ->select('users.name')
                        ->first();

                       // dd( $advisor1, $advisor2);





       // return redirect('show-work/',[$id])->with('success', 'สั่งงานเรียบร้อย');
       return view('Group.Work.show-work',compact( 'data_nameGroup', 'works', 'id', 'students', 'advisor1', 'advisor2'))->with('success', 'สั่งงานเรียบร้อย');


    }

    public function edit($id){


        $data = Work::find($id);
        //dd($data);

        return view('Group.Work.edit-work', compact('data'));

    }

    public function update( Request $request){

        //dd($request->document1);

        $data = DB::table('works')
                    ->where('id', '=', $request->work_id)
                    ->select('*')
                    ->first();
                    //dd($data->document1);

        if($request->file('document1') and $request->file('document2')){


            //ลบไฟล์เดิมออกจากฐานข้อมูล กรณีที่มีไฟลใหม่ 2 ไฟล์
            $file_name1 = $data->document1;
            unlink('storage/file/works/'.$file_name1);

            $file_name2 = $data->document2;
            unlink('storage/file/works/'.$file_name2);


            //เพิ่มไฟล์ใหม่ลง ฐานข้อมูลทั้ง 2 ไฟล์
            $file1 = $request->file('document1'); // img = ชื่อ name ใน input
            $document1 = time() . '.' . $file1->getClientOriginalName();
            $request->document1->move('storage/file/works', $document1); // img = 'img' ตัวนี้

            $file2 = $request->file('document2'); // img = ชื่อ name ใน input
            $document2 = time() . '.' . $file2->getClientOriginalName();
            $request->document2->move('storage/file/works', $document2); // img = 'img' ตัวนี้

            Work::find($request->work_id)->update([

                'title' => $request->title,
                'description' => $request->description,
                'document1' => $document1,
                'document2' => $document2,

            ]);

        }elseif($request->file('document1')){

            //ลบไฟล์เดิมออกจากฐานข้อมูล กรณีที่มีไฟลใหม่ 2 ไฟล์
            $file_name1 = $data->document1;
            unlink('storage/file/works/'.$file_name1);

            //เพิ่มไฟล์ใหม่ลง ฐานข้อมูลทั้ง 2 ไฟล์
            $file1 = $request->file('document1'); // img = ชื่อ name ใน input
            $document1 = time() . '.' . $file1->getClientOriginalName();
            $request->document1->move('storage/file/works', $document1); // img = 'img' ตัวนี้


            Work::find($request->work_id)->update([

                'title' => $request->title,
                'description' => $request->description,
                'document1' => $document1,

            ]);

        }elseif($request->file('document2')){

            $file_name2 = $data->document2;
            unlink('storage/file/works/'.$file_name2);

            $file2 = $request->file('document2'); // img = ชื่อ name ใน input
            $document2 = time() . '.' . $file2->getClientOriginalName();
            $request->document2->move('storage/file/works', $document2); // img = 'img' ตัวนี้

            Work::find($request->work_id)->update([

                'title' => $request->title,
                'description' => $request->description,
                'document2' => $document2,

            ]);


        }else{

            Work::find($request->work_id)->update([

                'title' => $request->title,
                'description' => $request->description,

            ]);

        }


        return redirect('sendwork/'.$request->work_id)->with('success', 'แก้ไขการสั่งงานสำเร็จ' );

    }

    public function delete($id){

        //ทำหลังจาก ทำcontroller ส่งงานเสร็จ

    }


    public function sendWork($id){

        $datas = Work::find($id);

        $data_nameGroup = Group::find($datas->group_id);

        $sendwork = DB::table('reports')
                        ->where('work_id', '=', $id)
                        ->select('*')
                        ->get();


        DB::table('notifications')
            ->where('works_id', $id)
            ->where('users_id', Auth::user()->id)
            ->select('id')
            ->delete();


        //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
        $all_notification2 = DB::table('notifications')
            ->where('users_id', Auth::user()->id)
            ->count();

        //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
        if($all_notification2 == 0){
            $all_notification2 = NULL;
        }
        User::find(Auth::user()->id)->update([

            'notification' => $all_notification2,
        ]);




        return view('Group.Work.work', compact('datas', 'data_nameGroup', 'sendwork'));
    }


}
