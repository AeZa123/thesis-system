<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

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

        }else{

            $data = new Report;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->work_id = $request->work_id;
            $data->save();

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
