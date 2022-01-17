@extends('layouts.test2')

@section('content1')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

    <style>
        body,
        h1 {
            font-family: "Raleway", sans-serif
        }

        body,
        html {
            height: 100%
        }

    </style>

    <body>

        <div class="container">
            <section id="header-footer">
                <h1 class="display-6">Top Downloads</h1><hr>
                <div class="row match-height">

                    @if ($count != null)

                        <div class="col-md-4 mt-3 text-center">
                            <img src="{{asset('storage/img/thesis/'. $datas[0]->img)}}" alt="" width="180" height="220">
                            <h1>{{$datas[0]->title}}</h1>
                            <p>{{$datas[0]->description}}</p>
                            <p>download : {{$count[0]->count_id}}</p>
                            <a href="public/show/{{ $datas[0]->id }}" type="button" class="btn btn-primary">คลิก</a>
                        </div>

                        <div class="col-md-4 mt-3 text-center">
                            <img src="{{asset('storage/img/thesis/'. $datas[1]->img)}}" alt="" width="180" height="220">
                            <h1>{{$datas[1]->title}}</h1>
                            <p>{{$datas[1]->description}}</p>
                            <p>download : {{$count[1]->count_id}}</p>
                            <a href="public/show/{{ $datas[1]->id }}" type="button" class="btn btn-primary">คลิก</a>
                        </div>

                        <div class="col-md-4 mt-3 text-center">
                            <img src="{{asset('storage/img/thesis/'. $datas[2]->img)}}" alt="" width="180" height="220">
                            <h1>{{$datas[2]->title}}</h1>
                            <p>{{$datas[2]->description}}</p>
                            <p>download : {{$count[1]->count_id}}</p>
                            <a href="public/show/{{ $datas[2]->id }}" type="button" class="btn btn-primary">คลิก</a>
                        </div>

                    @endif




                </div>
            </section>
        </div>


    </body>


@endsection


