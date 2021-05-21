@extends('layouts.head')

@section('content')

<div class="container">

    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-dark">
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif
    </div>

    <form action="{{route('createWork')}}" method="POST">
        @csrf

        <input type="hidden" name="group_id" value={{$id}}>

        <div class="">
            <button type="submit" class="btn btn-dark float-right">สั่งงาน</button>
        </div> <br>
    </form>


        <h1>กลุ่มโครงงาน :{{$data_nameGroup}}</h1><br>

    @foreach( $students as $data )

        <h4>นักศึกษา : {{ $data->name }}</h4>

    @endforeach


        <h4>ที่ปรึกษาหลัก : {{ $advisor1->name }}</h4>

    @if ($advisor2 != null)
        <h4>ที่ปรึกษาร่วม : {{ $advisor2->name }}</h4>
    @endif



    <br>
    @foreach($works as $work)
        <a href="/sendwork/{{ $work->id }}">
            <div class="row">
                <div class="col-md-12 col-sm-12 p-2 mb-3 bg-gradient-x-purple-blue pull-up" style="border-radius: 10px">
                    <h1 class="text-center text-white">งาน: {{ $work->title }}</h1>
                </div>
            </div>
        </a>
    @endforeach





</div>


@endsection
