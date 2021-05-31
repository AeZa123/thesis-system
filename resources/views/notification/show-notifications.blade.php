@extends('layouts.notification')



@section('content')

<h1>การแจ้งเตือน</h1><hr>
    <section id="text-alignments">

        @if (session()->has('success'))
            <div class="alert alert-info">
                <h4 class="text-white">{{ session()->get('success') }}</h4>
            </div>
        @endif

        <div class="row">

            @foreach ($datas as $data)
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">เรื่อง : {{$data->title}}</h4>
                            <p class="card-text">{{$data->description}}</p>

                            @if (Auth::user()->status_id == 2)
                                @if ($data->title == 'ส่งงาน')
                                    <a href="sendwork/{{$data->works_id}}" class="btn btn-info">รายละเอียด</a>
                                @endif
                                @if ($data->title == 'สร้างกลุ่ม')
                                    <a href="detail-notification/{{$data->id}}" class="btn btn-info">รายละเอียด</a>
                                @endif
                                @if ($data->title == 'อัพเล่มปริญญานิพนธ์')
                                    <a href="/show/{{$data->thesis_id}}" class="btn btn-primary">รายละเอียด</a>
                                @endif
                                @if ($data->title == 'อัพเล่มปริญญานิพนธ์')
                                    <a href="only-student/{{$data->id}}" class="btn btn-danger">ลบ</a>
                                @endif

                            @endif

                            @if (Auth::user()->status_id == 3)

                                @if ($data->title == 'สร้างกลุ่ม')
                                    <a href="only-student/{{$data->id}}" class="btn btn-primary">ทราบแล้ว</a>
                                @endif
                                @if ($data->title == 'สั่งงาน')
                                    <a href="sendwork/{{$data->works_id}}" class="btn btn-primary">คลิกดูงาน</a>
                                @endif
                                @if ($data->title == 'ส่งงาน')
                                    <a href="sendwork/{{$data->works_id}}" class="btn btn-info">รายละเอียด</a>
                                @endif
                                @if ($data->title == 'ตรวจเล่ม')
                                    <a href="only-student/{{$data->id}}" class="btn btn-primary">ทราบแล้ว</a>
                                @endif

                            @endif







                        </div>
                    </div>
                </div>
            @endforeach

        </div>



    </section>



@endsection
