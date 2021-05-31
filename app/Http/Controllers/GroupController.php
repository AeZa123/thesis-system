<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\notification;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
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



    //หน้าแสดงกลุ่มทั้งหมด
    public function index(){

        //$datas = Group::all();

        $datas = DB::table('groups')
                    ->where('status', 'ผ่าน')
                    ->get();


        return view('Group.show-group', compact('datas'));
    }

    //ไปหน้าจัดการกลุ่มของ Admin ที่เป็น table
    public function indexForAdmin(){

        $datas = Group::all();


        return view('Group.manage-group', compact('datas'));

    }


    //ไปหน้าสร้างกลุ่ม
    public function createGroup(){


        $datas = DB::table('users')
            ->join('statuses', 'users.status_id', '=', 'statuses.id')
            ->where('users.status_id', '=', '2')
            ->select('users.*')
            ->get();


        $users = DB::table('users')
            ->join('statuses', 'users.status_id', '=', 'statuses.id')
            ->where('users.status_id', '=', '3')
            ->where('group_id', '=', null)
            ->select('users.*')
            ->get();

        return view('Group.create-group', compact('datas','users'));
    }

    //บันทึกข้อมูลจาก form ลงใน table
    public function storage(Request $request){
        //dd($request);

        $data = new Group;
        $data->name_group = $request->name_group;
        $data->advisor_1 = $request->advisor_1;
        $data->advisor_2 = $request->advisor_2;
        $data->save();

        $name_group = Group::select('id')
                        ->where('name_group', '=', $request->name_group)
                        ->first();

        if($request->author_1 != 'select'){


            $notification = new notification;
            $notification->title = 'สร้างกลุ่ม';
            $notification->description = Auth::user()->name .' ได้สร้างกลุ่มโครงงานโดยมีคุณเป็นสมาชิก';
            $notification->users_id = $request->author_1; // คนที่อยู่ในกลุ่ม
            $notification->groups_id = $name_group->id; //group_id
            $notification->save();

             //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
             $all_notification = DB::table('notifications')
                                    ->where('users_id', $request->author_1)
                                    ->count();




            //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
            User::find($request->author_1)->update([
                'group_id' => $name_group->id,
                'notification' => $all_notification,
            ]);



        }


        if($request->author_2 != 'select'){



            //เพิ่ม ข้อมูลลงใน table notifications
            $notification = new notification;
            $notification->title = 'สร้างกลุ่ม';
            $notification->description = Auth::user()->name .' ได้สร้างกลุ่มโครงงานโดยมีคุณเป็นสมาชิก';
            $notification->users_id = $request->author_2; // คนที่อยู่ในกลุ่ม
            $notification->groups_id = $name_group->id; //group_id
            $notification->save();

            //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
            $all_notification2 = DB::table('notifications')
                                    ->where('users_id', $request->author_2)
                                    ->count();


            //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
            User::find($request->author_2)->update([
                'group_id' => $name_group->id,
                'notification' => $all_notification2,
            ]);

        }


        if($request->author_3 != 'select'){




            //เพิ่ม ข้อมูลลงใน table notifications
            $notification = new notification;
            $notification->title = 'สร้างกลุ่ม';
            $notification->description = Auth::user()->name .' ได้สร้างกลุ่มโครงงานโดยมีคุณเป็นสมาชิก';
            $notification->users_id = $request->author_3; // คนที่อยู่ในกลุ่ม
            $notification->groups_id = $name_group->id; //group_id
            $notification->save();

            //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
            $all_notification3 = DB::table('notifications')
                                    ->where('users_id', $request->author_3)
                                    ->get();

            //นับว่ามีกี่รายการ
            $count_notification3 = count($all_notification3);



            //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
            User::find($request->author_3)->update([
                'group_id' => $name_group->id,
                'notification' => $count_notification3,
            ]);


        }


        if($request->advisor_1 != 'select'){

            //เพิ่ม ข้อมูลลงใน table notifications
            $notification = new notification;
            $notification->title = 'สร้างกลุ่ม';
            $notification->description = Auth::user()->name .' ได้สร้างกลุ่มโครงงานโดยมีคุณที่ปรึกษาหลัก';
            $notification->users_id = $request->advisor_1; // คนที่อยู่ในกลุ่ม
            $notification->groups_id = $name_group->id; //group_id
            $notification->save();

            //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
            $all_notification4 = DB::table('notifications')
                                    ->where('users_id', $request->advisor_1)
                                    ->get();

            //นับว่ามีกี่รายการ
            $count_notification4 = count($all_notification4);


            //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
            User::find($request->advisor_1)->update([
                'notification' => $count_notification4,
            ]);

        }


        if($request->advisor_2 != 'select'){

            //เพิ่ม ข้อมูลลงใน table notifications
            $notification = new notification;
            $notification->title = 'สร้างกลุ่ม';
            $notification->description = Auth::user()->name .' ได้สร้างกลุ่มโครงงานโดยมีคุณที่ปรึกษาร่วม';
            $notification->users_id = $request->advisor_2; // คนที่อยู่ในกลุ่ม
            $notification->groups_id = $name_group->id; //group_id
            $notification->save();

            //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
            $all_notification5 = DB::table('notifications')
                                    ->where('users_id', $request->advisor_2)
                                    ->get();

            //นับว่ามีกี่รายการ
            $count_notification5 = count($all_notification5);


            //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
            User::find($request->advisor_2)->update([
                'notification' => $count_notification5,
            ]);

        }

        return redirect()->route('show-group')->with('success', 'สร้างกลุ่มสำเร็จ กรุณารออาจารย์กดยืนยัน');
    }

    //เข้าไปในกลุ่มแล้วแสดง รายการงานในกลุ่ม
    public function showWork($id){



        $data_nameGroup = Group::find($id)->name_group;


        $works = DB::table('works')
                        ->where('group_id', '=', $id)
                        ->select('works.title', 'works.id')
                        ->get();

        //ดึงรายชื่อ นศ ที่อยู่ในกลุ่ม
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



        return view('Group.Work.show-work', compact( 'works', 'advisor1', 'advisor2', 'id', 'students', 'data_nameGroup'));
    }

    //แก้ไขกลุ่ม
    public function edit($id){

        $group = Group::find($id);


        //data ที่เอาไปใส่ใน option ของ teacher
        $datas = DB::table('users')
                    ->join('statuses', 'users.status_id', '=', 'statuses.id')
                    ->where('users.status_id', '=', '2')
                    ->select('users.*')
                    ->get();

        //data ที่เอาไปใส่ใน option ของ student
        $users = DB::table('users')
                    ->join('statuses', 'users.status_id', '=', 'statuses.id')
                    ->where('users.status_id', '=', '3')
                    ->where('group_id', '=', null)
                    ->select('users.*')
                    ->get();
                    //dd($users);

        //ข้อมูลเดิมที่จะทำการแก้ไข
        $student = DB::table('users')
                        ->where('group_id', '=', $id)
                        ->select('users.*')
                        ->get();
        //dd(count($student));

        $student1 = 'select';
        $student2 = 'select';
        $student3 = 'select';

        for($i = 0; $i<count($student); $i++){

            if($i == 0){
                $student1 = $student[$i];
            }elseif($i ==  1){
                $student2 = $student[$i];
            }else{
                $student3 = $student[$i];
            }

        }


        //ข้อมูลเดิมที่จะทำการแก้ไข
        $teacher1 = DB::table('users')
                        ->join('groups', 'users.id', '=', 'groups.advisor_1')
                        ->where('groups.id', '=', $id)
                        ->where('users.id', '=', $group->advisor_1)
                        ->first();

        //ข้อมูลเดิมที่จะทำการแก้ไข
        $teacher2 = DB::table('users')
                        ->join('groups', 'users.id', '=', 'groups.advisor_2')
                        ->where('groups.id', '=', $id)
                        ->where('users.id', '=', $group->advisor_2)
                        ->first();


        return view('Group.edit-group', compact( 'student1', 'student2', 'student3', 'group', 'student', 'teacher1', 'teacher2', 'datas', 'users'));

    }



    //นำข้อมูลจากหน้าฟอร์มแก้ไขกลุ่ม มาบันทึกลง table
    public function editSave(Request $request){

       // dd($request);

        //ค้นหา name_group
        $group_data = Group::find($request->group_id);


        //หา id advisor เพื่อเอามาอัปเดตใน table groups
        $teachers = DB::table('users')
                        ->whereIn('name',[$request->advisor_1, $request->advisor_2])
                        ->orWhereIn('id',[$request->advisor_1, $request->advisor_2])
                        ->select('id')
                        ->get();


        // update advisor in table groups
        if(count($teachers) == 1){
            Group::find($request->group_id)->update([
                'name_group' => $request->name_group,
                'advisor_1' => $teachers[0]->id,
            ]);
        }else{
            Group::find($request->group_id)->update([
                'name_group' => $request->name_group,
                'advisor_1' => $teachers[0]->id,
                'advisor_2' => $teachers[1]->id,
            ]);
        }


        //หา id student เพื่อเอามาอัปเดต
        $students = DB::table('users')
                    ->whereIn('name',[$request->author_1, $request->author_2, $request->author_3])
                    ->orWhereIn('id',[$request->author_1, $request->author_2, $request->author_3])
                    ->select('id')
                    ->get();


        // หา id student ที่อยู่ในกลุ่มที่จะทำการอัปเดต
        $member = DB::table('users')
                    ->where('group_id', '=', $request->group_id)
                    ->select('id')
                    ->get();

        //ทำการแก้ไข column group_id ให้ว่าง ตาม id student อันเก่า
        for($i = 0; $i < count($member); $i++){

            User::find($member[$i]->id)->update([
                'group_id' => null
            ]);

        }

        //ทำการแก้ไข column group_id เอา id group ไปลงตาม id student อันใหม่
        for($i = 0; $i < count($students); $i++){

            User::find($students[$i]->id)->update([
                'group_id' => $group_data->id,
            ]);
        }


        return redirect()->route('manage-group')->with('success', 'แก้ไขข้อมูลกลุ่มโครงงานสำเร็จ');
    }



    public function delete(Request $request){


        $data = DB::table('works')
                    ->where('group_id', '=', $request->id)
                    ->select('*')
                    ->get();



       $test = DB::table('users')
                    ->where('group_id', '=', $request->id )
                    ->select('id')
                    ->get();



        for($i = 0; $i < count($test); $i++){

            User::find($test[$i]->id)->update([
                'group_id' => null,
            ]);
        }


        //check ว่าใน work มีข้อมูลหรือไม่
        for($i = 0; $i < count($data); $i++){

            if($data != null){

                if($data[$i]->document1 != null){
                    $file_name1 = $data[$i]->document1;
                    unlink('storage/file/works/'.$file_name1);

                }
                if($data[$i]->document2 != null){

                    $file_name2 = $data[$i]->document2;
                    unlink('storage/file/works/'.$file_name2);

                }

            }

        }


        //เหลือลบไฟล์
        Work::select('id')
            ->where('group_id', '=', $request->id)
            ->delete();


        Group::select()
            ->where('id', '=', $request->id)
            ->delete();

        return redirect()->route('manage-group')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');

    }



}
