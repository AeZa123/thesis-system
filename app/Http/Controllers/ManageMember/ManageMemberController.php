<?php

namespace App\Http\Controllers\ManageMember;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect,Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\Models\User;
use App\Models\Status;
use App\Imports\UserImport;
use App\Exports\UserExport;
use Excel;

class ManageMemberController extends Controller
{
    public function index(){

        $datas = DB::table('users')
            ->join('statuses','users.status_id', '=', 'statuses.id')
            ->select('users.*', 'statuses.name_status')
            ->get();
        //echo '<pre>';
        //print_r($data);

        return view('ManageMember.show-member', compact('datas'));
    }

    public function create(){
        return view('ManageMember.add-member');
    }

    public function profile($id){

        //$data = User::find($id);
        $data = DB::table('users')
                    ->join('statuses', 'users.status_id', '=', 'statuses.id')
                    ->where('users.id', '=', $id)
                    ->select('users.*', 'statuses.name_status')
                    ->first();
        //dd($data, $id);

        return view('ManageMember.profile-member', compact('data'));

    }


    public function store(Request $request){

        $r=$request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
        ]);
        //เก็ย active status
        $active_status = $request->active_status;




        $status = Status::where('name_status', '=', $request->status)
            ->select('statuses.id')->first();


            //เช็ค status ที่เข้ามาว่า มีหรือไม่ ถ้าไม่มีให้ column status_id = 4
        if(empty($request->status)){
            $status_id = '4';
        }else{
            $status_id = $status->id;
        }



        if($request->file('img')){
            $photo=$request->file('img'); // img = ชื่อ name ใน input
            $photoname=time().'.'.$photo->getClientOriginalExtension();
            $request->img->move('storage/img/profile',$photoname); // img = 'img' ตัวนี้



                $member_id = $request->member_id;
                User::updateOrCreate(
                    ['id'      => $member_id],
                    ['name'    => $request->name,
                    'email'    => $request->email,
                    'phone'    => $request->phone,
                    'img'      => $photoname,
                    'status_id'=> $status_id,
                    'password' => Hash::make($request->password),
                    'active'   => $active_status,

                ]);

            if(empty($member_id)){
                $msg = 'เพิ่มข้อมูลสมาชิกสำเร็จ!!';
            }else{
                $msg = 'แก้ไขข้อมูลสมาชิกสำเร็จ';
            }
            return redirect()->route('managemember')->with('success', $msg);

        }else{

            $member_id = $request->member_id;
            User::updateOrCreate(
                ['id'      => $member_id],
                ['name'    => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'status_id'=> $status_id,
                'password' => Hash::make($request->password),
                'active'   => $active_status,
            ]);

            if(empty($member_id)){
                $msg = 'เพิ่มข้อมูลสมาชิกสำเร็จ!!';
            }else{
                $msg = 'แก้ไขข้อมูลสมาชิกสำเร็จ';
            }
            return redirect()->route('managemember')->with('success', $msg);
        }
    }


    public function update(Request $request){

        $r=$request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        //เก็ย active status
        $active_status = $request->active_status;




        $status = Status::where('name_status', '=', $request->status)
            ->select('statuses.id')->first();


        if(Auth::user()->status_id == 2 or Auth::user()->status_id == 1){

            //เช็ค status ที่เข้ามาว่า มีหรือไม่ ถ้าไม่มีให้ column status_id = 4
            if(empty($request->status)){
                $status_id = '4';
            }else{
                $status_id = $status->id;
            }

        }else{
            $status_id = Auth::user()->status_id;
        }




        if($request->file('img')){




            //delete file photo thesis
            $data = User::find(Auth::user()->id);
            $file_name = $data->img;

            if($data->img != null){
                unlink('storage/img/profile/'.$file_name);
                $data->img = null;
                $data->save();
            }



            $photo=$request->file('img'); // img = ชื่อ name ใน input
            $photoname=time().'.'.$photo->getClientOriginalExtension();
            $request->img->move('storage/img/profile',$photoname); // img = 'img' ตัวนี้

                $member_id = $request->member_id;
                //$id = intval($member_id);
                //dd($id, $request);
                /*
                User::find($id)->update([
                    'name'    => $request->name,
                    'email'    => $request->email,
                    'phone'    => $request->phone,
                    'img'      => $photoname,
                    'status_id'=> $status_id,
                    'active'   => $active_status
                ]);
                */

                //dd($request->member_id);

                DB::table('users')
                    ->where('id', $request->member_id)
                    ->update([
                        'name' => $request->name,
                        'email'    => $request->email,
                        'phone'    => $request->phone,
                        'img'      => $photoname,
                        'status_id'=> $status_id,
                        'active'   => $active_status
                    ]);

                    /*
                    $member_id = $request->member_id;
                    User::updateOrCreate(
                        ['id'      => $member_id],
                        ['name'    => $request->name,
                        'email'    => $request->email,
                        'phone'    => $request->phone,
                        'img'      => $photoname,
                        'status_id'=> $status_id,
                        'active'   => $active_status,
                    ]);
                    */

            if(empty($member_id)){
                $msg = 'เพิ่มข้อมูลสมาชิกสำเร็จ!!';
            }else{
                $msg = 'แก้ไขข้อมูลสมาชิกสำเร็จ';
            }
            return back()->with('success', $msg);

        }else{

            /*
            $member_id = $request->member_id;
            $id = intval($member_id);
            User::find($id)->update([
                'name'    => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'status_id'=> $status_id,
                'active'   => $active_status,
            ]);
            */

            $member_id = $request->member_id;

            DB::table('users')
                ->where('id', $request->member_id)
                ->update([
                    'name' => $request->name,
                    'email'    => $request->email,
                    'phone'    => $request->phone,
                    'status_id'=> $status_id,
                    'active'   => $active_status
                ]);




            if(empty($member_id)){
                $msg = 'เพิ่มข้อมูลสมาชิกสำเร็จ!!';
            }else{
                $msg = 'แก้ไขข้อมูลสมาชิกสำเร็จ';
            }
            return back()->with('success', $msg);
        }

    }


    public function edit($id){

        $status = Status::all();
       // $data = User::find($id);
        $data = DB::table('users')
                    ->join('statuses', 'users.status_id', '=', 'statuses.id')
                    ->where('users.id', $id)
                    ->select('users.*', 'statuses.name_status')
                    ->first();
        return view('ManageMember.edit-member', compact('data', 'status'));

    }

    public function delete(Request $request){

        $id = $request->id;
        $data = User::find($id);
        $data->delete();
        return redirect()->route('managemember')->with('success','ลบข้อมูลเรียบร้อย');
    }


    public function importFileCSV(Request $request){

        Excel::import(new UserImport, $request->file_csv);

        return redirect()->route('managemember')->with('success', 'Import file CSV สำเร็จ');

    }

    public function exportUserToExcel(){

        return Excel::download(new UserExport, 'UserList.xlsx');
    }

    public function exportUserToCSV(){

        return Excel::download(new UserExport, 'UserList.csv');
    }



    public function updatepassword(Request $request){

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);


        return back()->with('success', 'เปลี่ยนรหัสผ่านสำเร็จ');


    }

}
