<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Group;
use App\Models\User;
use App\Models\notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
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







    public function storage(Request $request){

        //dd($request);

        if($request->file('document1') and $request->file('document2')){


            $file1 = $request->file('document1'); // img = ชื่อ name ใน input
            $document1 = time() . '-' . $file1->getClientOriginalName();
            $request->document1->move('storage/file/works', $document1); // img = 'img' ตัวนี้

            $file2 = $request->file('document2'); // img = ชื่อ name ใน input
            $document2 = time() . '-' . $file2->getClientOriginalName();
            $request->document2->move('storage/file/works', $document2); // img = 'img' ตัวนี้

            $data = new Report;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->document1 = $document1;
            $data->document2 = $document2;
            $data->work_id = $request->work_id;
            $data->save();


           // $data_group = Group::find($request->group_id);

           /* $work_id = DB::table('works')
                    ->where('title','LIKE', '%'.$request->title.'%' )
                    ->first();
            */

            $group_id = DB::table('works')
                        ->where('id', $request->work_id)
                        ->select('group_id')
                        ->first();

            $advisor = Group::find($group_id->group_id);

            $user_id = DB::table('users')
                    ->where('group_id', $group_id->group_id)
                    ->get();

            if($advisor->advisor_1 != 'select'){

                //เพิ่ม ข้อมูลลงใน table notifications
                $notification = new notification;
                $notification->title = 'ส่งงาน';
                $notification->description = Auth::user()->name .' ได้ส่งงานที่มอบหมาย';
                $notification->users_id = $advisor->advisor_1; // คนที่อยู่ในกลุ่ม
                $notification->groups_id = $group_id->group_id; //group_id
                $notification->works_id = $request->work_id; //group_id
                $notification->save();


                //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                $all_notification2 = DB::table('notifications')
                    ->where('users_id', $advisor->advisor_1)
                    ->count();

                 //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                if($all_notification2 == 0){
                    $all_notification2 = NULL;
                }


                User::find($advisor->advisor_1)->update([

                    'notification' => $all_notification2,
                ]);

            }
            if($advisor->advisor_2 != 'select'){

                //เพิ่ม ข้อมูลลงใน table notifications
                $notification = new notification;
                $notification->title = 'ส่งงาน';
                $notification->description = Auth::user()->name .' ได้ส่งงานที่มอบหมาย';
                $notification->users_id = $advisor->advisor_2; // คนที่อยู่ในกลุ่ม
                $notification->groups_id = $group_id->group_id; //group_id
                $notification->works_id = $request->work_id; //group_id
                $notification->save();

                //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                $all_notification2 = DB::table('notifications')
                    ->where('users_id', $advisor->advisor_2)
                    ->count();

                 //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                if($all_notification2 == 0){
                    $all_notification2 = NULL;
                }


                User::find($advisor->advisor_2)->update([

                    'notification' => $all_notification2,
                ]);

            }

            for($i=0; $i<count($user_id); $i++){

                //เพิ่ม ข้อมูลลงใน table notifications
                $notification = new notification;
                $notification->title = 'ส่งงาน';
                $notification->description = Auth::user()->name .' ได้ส่งงานที่มอบหมาย';
                $notification->users_id = $user_id[$i]->id; // คนที่อยู่ในกลุ่ม
                $notification->groups_id = $group_id->group_id; //group_id
                $notification->works_id = $request->work_id; //group_id
                $notification->save();

                //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                $all_notification2 = DB::table('notifications')
                    ->where('users_id', $user_id[$i]->id)
                    ->count();

                 //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                if($all_notification2 == 0){
                    $all_notification2 = NULL;
                }

                User::find($user_id[$i]->id)->update([

                    'notification' => $all_notification2,
                ]);

            }





        }elseif($request->file('document1')){

            $file1 = $request->file('document1'); // img = ชื่อ name ใน input
            $document1 = time() . '-' . $file1->getClientOriginalName();
            $request->document1->move('storage/file/works', $document1); // img = 'img' ตัวนี้

            $data = new Report;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->document1 = $document1;
            $data->work_id = $request->work_id;
            $data->save();


            $group_id = DB::table('works')
                ->where('id', $request->work_id)
                ->select('group_id')
                ->first();

            $advisor = Group::find($group_id->group_id);

            $user_id = DB::table('users')
                    ->where('group_id', $group_id->group_id)
                    ->get();


                    if($advisor->advisor_1 != 'select'){

                        //เพิ่ม ข้อมูลลงใน table notifications
                        $notification = new notification;
                        $notification->title = 'ส่งงาน';
                        $notification->description = Auth::user()->name .' ได้ส่งงานที่มอบหมาย';
                        $notification->users_id = $advisor->advisor_1; // คนที่อยู่ในกลุ่ม
                        $notification->groups_id = $group_id->group_id; //group_id
                        $notification->works_id = $request->work_id; //group_id
                        $notification->save();

                        //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                        $all_notification2 = DB::table('notifications')
                            ->where('users_id', $advisor->advisor_1)
                            ->count();

                         //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                        if($all_notification2 == 0){
                            $all_notification2 = NULL;
                        }


                        User::find($advisor->advisor_1)->update([

                            'notification' => $all_notification2,
                        ]);


                    }
                    if($advisor->advisor_2 != 'select'){

                        //เพิ่ม ข้อมูลลงใน table notifications
                        $notification = new notification;
                        $notification->title = 'ส่งงาน';
                        $notification->description = Auth::user()->name .' ได้ส่งงานที่มอบหมาย';
                        $notification->users_id = $advisor->advisor_2; // คนที่อยู่ในกลุ่ม
                        $notification->groups_id = $group_id->group_id; //group_id
                        $notification->works_id = $request->work_id; //group_id
                        $notification->save();

                        //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                        $all_notification2 = DB::table('notifications')
                            ->where('users_id', $advisor->advisor_2)
                            ->count();

                         //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                        if($all_notification2 == 0){
                            $all_notification2 = NULL;
                        }


                        User::find($advisor->advisor_2)->update([

                            'notification' => $all_notification2,
                        ]);



                    }



            for($i=0; $i<count($user_id); $i++){

                //เพิ่ม ข้อมูลลงใน table notifications
                $notification = new notification;
                $notification->title = 'ส่งงาน';
                $notification->description = Auth::user()->name .' ได้ส่งงานที่มอบหมาย';
                $notification->users_id = $user_id[$i]->id; // คนที่อยู่ในกลุ่ม
                $notification->groups_id = $group_id->group_id; //group_id
                $notification->works_id = $request->work_id; //group_id
                $notification->save();

                //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                $all_notification2 = DB::table('notifications')
                    ->where('users_id', $user_id[$i]->id)
                    ->count();

                //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                if($all_notification2 == 0){
                    $all_notification2 = NULL;
                }

                User::find($user_id[$i]->id)->update([

                    'notification' => $all_notification2,
                ]);

            }



        }elseif($request->file('document2')){

            $file2 = $request->file('document2'); // img = ชื่อ name ใน input
            $document2 = time() . '-' . $file2->getClientOriginalName();
            $request->document2->move('storage/file/works', $document2); // img = 'img' ตัวนี้

            $data = new Report;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->document2 = $document2;
            $data->work_id = $request->work_id;
            $data->save();


            $group_id = DB::table('works')
                ->where('id', $request->work_id)
                ->select('group_id')
                ->first();

            $advisor = Group::find($group_id->group_id);

            $user_id = DB::table('users')
                    ->where('group_id', $group_id->group_id)
                    ->get();


                    if($advisor->advisor_1 != 'select'){

                        //เพิ่ม ข้อมูลลงใน table notifications
                        $notification = new notification;
                        $notification->title = 'ส่งงาน';
                        $notification->description = Auth::user()->name .' ได้ส่งงานที่มอบหมาย';
                        $notification->users_id = $advisor->advisor_1; // คนที่อยู่ในกลุ่ม
                        $notification->groups_id = $group_id->group_id; //group_id
                        $notification->works_id = $request->work_id; //group_id
                        $notification->save();


                        //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                        $all_notification2 = DB::table('notifications')
                            ->where('users_id', $advisor->advisor_1)
                            ->count();

                        //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                        if($all_notification2 == 0){
                            $all_notification2 = NULL;
                        }


                        User::find($advisor->advisor_1)->update([

                            'notification' => $all_notification2,
                        ]);


                    }
                    if($group_id->advisor_2 != 'select'){

                        //เพิ่ม ข้อมูลลงใน table notifications
                        $notification = new notification;
                        $notification->title = 'ส่งงาน';
                        $notification->description = Auth::user()->name .' ได้ส่งงานที่มอบหมาย';
                        $notification->users_id = $advisor->advisor_2; // คนที่อยู่ในกลุ่ม
                        $notification->groups_id = $group_id->group_id; //group_id
                        $notification->works_id = $request->work_id; //group_id
                        $notification->save();


                        //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                        $all_notification2 = DB::table('notifications')
                            ->where('users_id', $advisor->advisor_2)
                            ->count();

                        //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                        if($all_notification2 == 0){
                            $all_notification2 = NULL;
                        }


                        User::find($advisor->advisor_2)->update([

                            'notification' => $all_notification2,
                        ]);




                    }



            for($i=0; $i<count($user_id); $i++){

                //เพิ่ม ข้อมูลลงใน table notifications
                $notification = new notification;
                $notification->title = 'ส่งงาน';
                $notification->description = Auth::user()->name .' ได้ส่งงานที่มอบหมาย';
                $notification->users_id = $user_id[$i]->id; // คนที่อยู่ในกลุ่ม
                $notification->groups_id = $group_id->group_id; //group_id
                $notification->works_id = $request->work_id; //group_id
                $notification->save();

                //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                $all_notification2 = DB::table('notifications')
                    ->where('users_id', $user_id[$i]->id)
                    ->count();

                //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                if($all_notification2 == 0){
                    $all_notification2 = NULL;
                }


                User::find($user_id[$i]->id)->update([

                    'notification' => $all_notification2,
                ]);

            }



        }else{

            $data = new Report;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->work_id = $request->work_id;
            $data->save();


            $group_id = DB::table('works')
                ->where('id', $request->work_id)
                ->select('group_id')
                ->first();

            $advisor = Group::find($group_id->group_id);

            $user_id = DB::table('users')
                    ->where('group_id', $group_id->group_id)
                    ->get();


                    if($advisor->advisor_1 != 'select'){


                        //เพิ่ม ข้อมูลลงใน table notifications
                        $notification = new notification;
                        $notification->title = 'ส่งงาน';
                        $notification->description = Auth::user()->name .' ได้ส่งงานที่มอบหมาย';
                        $notification->users_id = $advisor->advisor_1; // คนที่อยู่ในกลุ่ม
                        $notification->groups_id = $group_id->group_id; //group_id
                        $notification->works_id = $request->work_id; //group_id
                        $notification->save();


                        //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                        $all_notification2 = DB::table('notifications')
                            ->where('users_id', $advisor->advisor_1)
                            ->count();

                        //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                        if($all_notification2 == 0){
                            $all_notification2 = NULL;
                        }


                        User::find($advisor->advisor_1)->update([

                            'notification' => $all_notification2,
                        ]);


                    }
                    if($advisor->advisor_2 != 'select'){

                        //เพิ่ม ข้อมูลลงใน table notifications
                        $notification = new notification;
                        $notification->title = 'ส่งงาน';
                        $notification->description = Auth::user()->name .' ได้ส่งงานที่มอบหมาย';
                        $notification->users_id = $advisor->advisor_2; // คนที่อยู่ในกลุ่ม
                        $notification->groups_id = $group_id->group_id; //group_id
                        $notification->works_id = $request->work_id; //group_id
                        $notification->save();

                        //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                        $all_notification2 = DB::table('notifications')
                            ->where('users_id', $advisor->advisor_2)
                            ->count();

                        //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                        if($all_notification2 == 0){
                            $all_notification2 = NULL;
                        }


                        User::find($advisor->advisor_2)->update([

                            'notification' => $all_notification2,
                        ]);

                    }



            for($i=0; $i<count($user_id); $i++){

                //เพิ่ม ข้อมูลลงใน table notifications
                $notification = new notification;
                $notification->title = 'ส่งงาน';
                $notification->description = Auth::user()->name .' ได้ส่งงานที่มอบหมาย';
                $notification->users_id = $user_id[$i]->id; // คนที่อยู่ในกลุ่ม
                $notification->groups_id = $group_id->group_id; //group_id
                $notification->works_id = $request->work_id; //group_id
                $notification->save();


                //หาแจ้งเตือนทั้งหมดที่ user คนนี้มี
                $all_notification2 = DB::table('notifications')
                    ->where('users_id', $user_id[$i]->id)
                    ->count();


                 //เพิ่มค่า จำนวนการแจ้งเตือนลงใน column notification ใน table users
                if($all_notification2 == 0){
                    $all_notification2 = NULL;
                }


                User::find($user_id[$i]->id)->update([

                    'notification' => $all_notification2,
                ]);


            }

        }










        return redirect('sendwork/'.$request->work_id)->with('success', 'ส่งงานสำเร็จ' );

    }



    public function delete($id){

       $data = DB::table('reports')
                    ->where('id', '=', $id)
                    ->select('*')
                    ->first();

        if($data->document1 != null){

            unlink('storage/file/works/'.$data->document1);

        }
        if($data->document2 != null){

            unlink('storage/file/works/'.$data->document2);

        }

        $work_id = $data->work_id;

        Report::find($id)->delete();

        return redirect('sendwork/'.$work_id)->with('success', 'ลบข้อมูลสำเร็จ' );


    }
}
