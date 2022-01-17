<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use App\Models\Download;
use App\Models\Thesis;
use Illuminate\Support\Facades\Auth;
use App\Helpers\UserSystemInfo;
use Illuminate\Support\Facades\DB;

class DownloadController extends Controller
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





    public function index(){

        $datas = DB::table('downloads')
                    ->join('users', 'downloads.users_id', '=', 'users.id')
                    ->join('theses', 'downloads.theses_id', '=', 'theses.id')
                    ->join('flags', 'downloads.flag_id', '=', 'flags.id')

                    ->select('theses.title', 'users.name', 'downloads.*', 'flags.name_flag', 'downloads.*')
                    ->get();


        return view('Download.history-download', compact('datas'));
    }


    //download thesis
    public function downloads(Request $request, $file_thesis)
    {


      // $ip1 = $request->ip();
      // $ip2 = UserSystemInfo::get_ip();
      // $ip3 = request()->ip();

       // dd($ip1, $ip2,  $ip3);

        //$location = Location::get($request->ip());
        $location = UserSystemInfo::get_ip();

        //$request->ip();
        //dd(UserSystemInfo::get_ip());

        if($location == '127.0.0.1'){



             $id_thesis = Thesis::select('id')
                        ->where('file_thesis', '=', $file_thesis)
                        ->first();


            $id_flag = DB::table('flags')
                        ->where('name_flag','LIKE', '%'.'localhost'.'%' )
                        ->select('id')
                        ->first();


            $data = new Download;
            $data->users_id = Auth::user()->id;
            $data->theses_id = $id_thesis->id;
            $data->ip_address = $request->ip();
            $data->browser = UserSystemInfo::get_browsers();
            $data->device = UserSystemInfo::get_device();
            $data->os = UserSystemInfo::get_os();
            $data->country = 'localhost';
            $data->province = 'localhost';
            $data->city = 'localhost';
            $data->latitude = 'localhost';
            $data->longitude = 'localhost';
            $data->flag_id = $id_flag->id;

            $data->save();



        }else{


             $id_thesis = Thesis::select('id')
                        ->where('file_thesis', '=', $file_thesis)
                        ->first();

            $flag = $location->countryName;
            $id_flag = DB::table('flags')
                        ->where('name_flag','LIKE', '%'.$flag.'%' )
                        ->select('id')
                        ->first();


            $data = new Download;
            $data->users_id = Auth::user()->id;
            $data->theses_id = $id_thesis->id;
            $data->ip_address = $location->ip;
            $data->browser = UserSystemInfo::get_browsers();
            $data->device = UserSystemInfo::get_device();
            $data->os = UserSystemInfo::get_os();
            $data->country = $location->countryName;
            $data->province = $location->regionName;
            $data->city = $location->cityName;
            $data->latitude = $location->latitude;
            $data->longitude = $location->longitude;
            $data->flag_id = $id_flag->id;

            $data->save();


        }

        return response()->download('storage/file/thesis/' . $file_thesis);
    }


    public function downloadsWork($document){

        return response()->download('storage/file/works/' . $document);

    }

    public function downloadsReport($document){

        return response()->download('storage/file/works/' . $document);

    }


    public function details($id){

        $data = DB::table('downloads')
                    ->join('users', 'downloads.users_id', '=', 'users.id')
                    ->join('theses', 'downloads.theses_id', '=', 'theses.id')
                    ->join('flags', 'downloads.flag_id', '=', 'flags.id')
                    ->where('downloads.id', '=', $id)
                    ->select('downloads.*', 'users.name', 'theses.title', 'flags.name_flag')
                    ->first();

        //$data->name;
        //dd($data->name);

        return view('Download.detail', compact('data'));

        echo '<pre>';
        print_r($data);


    }


    public function topdownload(){

       // $sql = "SELECT id, count(theses_id) AS num_thesises FROM downloads GROUP BY id  ORDER BY num_thesises DESC";
        /*
        $data = DB::table('downloads')
                    ->select('theses_id',DB::raw('COUNT(theses_id) AS count_id'))
                    ->orderBy('id','DESC')
                    ->groupBy('id')
                    ->get();
        */

       /* $count = DB::table('downloads')
                    ->select('theses_id',DB::raw('count(theses_id) AS count_id'))
                    ->groupBy('theses_id')
                    ->get(); */
        //dd( $test);

        /*
        $total_downloads = array();
        array_push($total_downloads, $count[0]->count_id, $count[1]->count_id, $count[2]->count_id);

        $datas = DB::table('theses')
                    ->whereIn('theses.id', [$count[0]->theses_id, $count[1]->theses_id, $count[2]->theses_id ])
                    ->get();

        dd($datas, $total_downloads);
        return view('public.top-download', compact('datas'));

        */
    }


}
