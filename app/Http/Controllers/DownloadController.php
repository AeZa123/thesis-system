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
                    ->select('theses.title', 'users.name', 'downloads.*', 'flags.name_flag')
                    ->get();


        return view('Download.history-download', compact('datas'));
    }


    //download thesis
    public function downloads(Request $request, $file_thesis)
    {

        $location = Location::get('1.32.191.255');

        //$request->ip();


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


    }


}
