@extends('layouts.head')

@section('content')

<div class="container">
    <h1>ข้อมูลการดาวน์โหลด</h1>

</div>

<div class="container">

    <div id="app">


        <div class="card mb-3 align-items-center">

                <table width="35%" border="2">
                    <tbody >
                        <tr >
                            <td class="p-1">ชื่อสมาชิก</th>
                            <td class="p-1">{{$data->name}}</td>
                        </tr>
                        <tr>
                            <td class="p-1">ชื่อปริญญานิพนธ์ที่โหลด</th>
                            <td class="p-1">{{$data->title}}</td>
                        </tr>
                        <tr>
                            <td class="p-1">ไอพีแอดเดรส</th>
                            <td class="p-1">{{$data->ip_address}}</td>
                        </tr>
                        <tr>
                            <td class=" p-1">บราวเซอร์</th>
                            <td class=" p-1">{{$data->browser}}</td>
                        </tr>
                        <tr>
                            <td class="p-1">อุปกรณ์</th>
                            <td class="p-1">{{$data->device}}</td>
                        </tr>
                        <tr>
                            <td class="p-1">ระบบ</th>
                            <td class="p-1">{{$data->os}}</td>
                        </tr>
                        <tr>
                            <td class="p-1">ธงประเทศ</th>
                            <td class="p-1"><img src="{{asset('storage/img/flags/'.$data->name_flag)}}" width="50px" height="35px" alt=""></td>
                        </tr>
                        <tr>
                            <td class="p-1">ชื่อประเทศ</th>
                            <td class="p-1">{{$data->country}}</td>
                        </tr>
                        <tr>
                            <td class="p-1">เมือง</th>
                            <td class="p-1">{{$data->province}}</td>
                        </tr>
                        <tr>
                            <td class="p-1">วันที่ดาวน์โหลด</th>
                            <td class="p-1">{{$data->created_at}}</td>
                        </tr>

                    </tbody>
                </table>
        </div>

    </div>
</div>

@endsection
