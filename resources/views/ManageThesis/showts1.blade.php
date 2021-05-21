@extends('layouts.head')

@section('content')
<div class="container">
    <div class="">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1></h1>

                    <div ng-repeat="(key,ele) in data.result track by key" class="col-md-12 ng-scope">
                        <div class="col-md-12 col-sm-12 col-xs-12  search-item">
                            <div class="col-md-1 col-sm-1 col-xs-12">
                                <span class="num_list ng-binding"> </span>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 img_cover">
                                <a href="">
                                    <img class="img-responsive tu-img-cover" title="ปกของ " src="https://img1.thaipng.com/20180822/ltf/kisspng-vector-graphics-clip-art-pixel-8-bit-color-image-png-avatan-plus-5b7ceada0a0643.8261107315349132420411.jpg">
                                </a>
                            </div>

                            <div class="col-md-8 col-sm-8 col-xs-12">


                                <p class="hidden-xs ng-binding">
                                    <span class="item-label">Title : </span>
                                    {{$data->title}}
                                </p>
                                @foreach($teachers as $teacher)
                                <p class="hidden-xs">
                                    <span class="item-label">ที่ปรึกษา : </span>
                                        <span ng-bind-html="to_trusted(ele.author_highlight)" class="ng-binding">{{$teacher->name}}</span>
                                </p>
                                @endforeach

                                @foreach($students as $student)
                                <p class="hidden-xs">
                                    <span class="item-label">ผู้เขียน : </span>
                                        <span ng-bind-html="to_trusted(ele.author_highlight)" class="ng-binding">{{$student->name}}</span>
                                </p>
                                @endforeach
                                <p>
                                    <span class="item-label">รายละเอียด: </span>
                                    <span ng-bind-html="ele.pubyear_highlight" class="ng-binding"> {{$data->description}}</span>
                                </p>

                                <a href="/download/thesis/{{ $data->file_thesis }}"> download</a>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection


