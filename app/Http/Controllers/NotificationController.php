<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{




    public function index(){



            //เช็คจำนวนการแจ้งเตือน และเช้คว่ามี group ไหนบ้าง
            $datas = DB::table('notifications')
                ->where('users_id', Auth::user()->id)
                //->select('groups_id')
                ->get();

            //dd($datas);

        return view('notification.show-notifications', compact('datas',));
    }

    public function onlyStudent($id){


        DB::table('notifications')
            ->where('id', $id)
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



    public function detail( $id){

        $data = notification::find($id);



        if($data->groups_id != NULL){

            $query = DB::table('notifications')
                        ->where('groups_id', '=', $data->groups_id)
                        ->get('users_id');

            $name_group = DB::table('groups')
                        ->where('id', $data->groups_id)
                        ->select('name_group', 'id')
                        ->first();


            $name = array();

            for($i=0; $i<count($query); $i++){

                $query1 = DB::table('users')
                        ->where('id', $query[$i]->users_id)
                        //->select('name')
                        ->first();
                        array_push($name, $query1);
            }

            //dd($name_group);
        }


        if($data->works_id != NULL){

            $query = DB::table('notifications')
                        ->where('groups_id', '=', $data->works_id)
                        ->get('users_id');

            $name_group = DB::table('works')
                        ->where('id', $data->works_id)
                        ->select('title')
                        ->first();

            $name = array();

            for($i=0; $i<count($query); $i++){

                $query1 = DB::table('users')
                        ->where('id', $query[$i]->users_id)
                        //->select('name')
                        ->first();
                        array_push($name, $query1);
            }

            //dd($name_group);
        }


        //dd($name , $name_group);


        return view('notification.detail-notification', compact('name', 'name_group'));
    }



    public function confirm_group(Request $request){

        $request->validate([
            'confirm' => 'required',
        ]);

       // dd($request);

        Group::find($request->group_id)->update([

            'status' => $request->confirm,
        ]);

        DB::table('notifications')
            ->where('users_id', Auth::user()->id)
            ->where('groups_id', $request->group_id)
            ->delete();



        if($request->confirm == 'ไม่ผ่าน'){

            DB::table('groups')
                ->where('id', $request->group_id)
                ->delete();

            $test = DB::table('users')
                ->where('group_id', '=', $request->group_id )
                ->select('id')
                ->get();

            for($i = 0; $i < count($test); $i++){

                User::find($test[$i]->id)->update([
                    'group_id' => null,
                ]);

                $new = new notification;
                $new->title = 'สร้างกลุ่ม';
                $new->description = 'กลุ่มของคุณไม่ผ่าน กรุณาสร้างกลุ่มขึ้นใหม่';
                $new->users_id = $test[$i]->id;
                $new->groups_id = NULL;
                $new->works_id = NULL;
                $new->thesis_id = NULL;
                $new->save();


                $num = DB::table('notifications')
                    ->where('users_id',$test[$i]->id)
                    ->get();

                $count = count($num);

                User::find($test[$i]->id)->update([

                    'notification' => $count,
                ]);


                if($count == 0){
                    $count = NULL;
                }


                User::find($test[$i]->id)->update([

                    'notification' => $count,
                ]);

            }

          // DB::table('notifications')
           //     ->where('groups_id', $request->group_id)

        }

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

        return redirect()->route('show-notification')->with('success', 'คุณยืนยันเรียบร้อยแล้ว');

    }










}




