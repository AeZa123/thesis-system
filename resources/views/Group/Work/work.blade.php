@extends('layouts.search')

@section('content1')

<style>
    .ln-line{
        border-radius: 10px; border:10px solid white;
            white-space: -moz-pre-wrap;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            white-space: -pre-wrap;
            white-space: -o-pre-wrap;
            word-wrap: break-word;
    }


</style>

<div class="container">
    <div class="mb-3 bg-bitbucket col-md-12 p-1" style="border-radius: 10px;">
        <h1 class="display-4 text-white">กลุ่ม : {{ $data_nameGroup->name_group }}</h1>
    </div>

    <div class="container mb-3">
        @if (session()->has('success'))
            <div class="alert alert-danger">
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif
    </div>

<!--border-black bg-chartbg -->
    <div class="row justify-content-center">

        @if ($datas->document1 == null OR $datas->document2 == null)


            <div class="col-sm-12 col-md-10 bg-facebook ln-line effect2">

                <h1 class="text-white mt-1 display-4">มอบหมายงาน : {{ $datas->title }}</h1>
                <h5 class=" text-warning radai">คำอธิบาย : {{ $datas->description }}</h5>
                @if ($datas->document1)
                    <a href="/download/work/{{ $datas->document1 }}" class="btn btn-blue m-2"> document 1</a>
                @endif
                @if ($datas->document2)
                    <a href="/download/work/{{ $datas->document2 }}" class="btn btn-blue m-2"> document 2</a>
                @endif
                <div class="text-right">
                    <a href="/editPage/{{$datas->id}}" type="button" class="btn btn-warning m-2">แก้ไข</a>
                </div>

            </div>


        @endif

        @if ($datas->document1 != null AND $datas->document2 != null)



            <div class="col-sm-12 col-md-10 bg-facebook ln-line effect2">

                <h1 class="text-white mt-1 display-4">มอบหมายงาน : {{ $datas->title }}</h1>
                <h5 class=" text-warning radai">คำอธิบาย : {{ $datas->description }}</h5>
                @if ($datas->document1)
                    <a href="/download/work/{{ $datas->document1 }}" class="btn btn-blue m-2"> document 1</a>
                @endif
                @if ($datas->document2)
                    <a href="/download/work/{{ $datas->document2 }}" class="btn btn-blue m-2"> document 2</a>
                @endif
                <div class="text-right">
                    <a href="/editPage/{{$datas->id}}" type="button" class="btn btn-warning m-2">แก้ไข</a>
                </div>
            </div>


        @endif

    </div>

    @foreach ($sendwork as $data )

        <div class="row mt-2 " >
            <div class="col-2" >

            </div>

            <div class="col-8 bg-facebook p-2 ln-line">
                <div class="text-right ">
                    <a href="/delete/report/{{$data->id}}" class="text-white"  onclick="return confirm('คุณต้องการลบข้อมูลที่เลือกหรือไม่ ?')">ลบ</a>
                </div>
                <h1 class="text-white"> ชื่องาน : {{$data->title}}</h1>
                <h5 class="text-white"> คำอธิบาย : {{$data->description}}</h5>

                @if ($data->document1 != null)
                    <a href="/download/report/{{ $data->document1 }}" class="btn btn-blue mb-1"> document 1</a><br>
                @endif

                @if ($data->document2 != null)
                    <a href="/download/report/{{ $data->document2 }}" class="btn btn-blue mb-1"> document 2</a>
                @endif

                <p class="text-white">date : {{$data->created_at}}</p>
            </div>

            <div class="col-2">

            </div>

        </div>

    @endforeach





<!-- form comment -->
    @if (Auth::user()->id == $data_nameGroup->advisor_1 or Auth::user()->id == $data_nameGroup->advisor_2)
        <div class="form-group">
            <div class=" mt-5 row justify-content-center">
                <div class="col-md-6">
                    <form action="{{ route('workstorag') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="work_id" value="{{$datas->id}}">


                        <label class="mb-1" for="">file : </label>
                        <input type="file" name="document1"><br>
                        <label class="mb-1" for="">file : </label>
                        <input type="file" name="document2">

                        <div class="row">
                            <div class="col-md-1 col-sm-12">
                                <label class="text-right" for="">title</label>
                            </div>
                            <div class="col-md-11 col-sm-12">
                                <input class="form-control mb-1" name="title" type="text">
                            </div>
                        </div>
                        <label for="description">Description</label>
                        <textarea class="form-control  " name="description"  rows="5"></textarea><br>
                        <button type="submit" class="btn btn-pink float-right btn-rounded z-depth-1">ส่งงาน</button>
                    </form>
                </div>

            </div>
        </div>
    @endif



<!-- end form comment -->


</div>


@endsection
