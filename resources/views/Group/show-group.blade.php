@extends('layouts.group')

@section('content1')

<h1>กลุ่มโครงงาน</h1>

<div class="container mb-3">
    @if (session()->has('success'))
        <div class="alert alert-info">
            <h4 class="text-white">{{ session()->get('success') }}</h4>
        </div>
    @endif
</div>

<div class="mb-4 mr-3">
    <div class="">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{route('create-group')}}" style="padding-top: 0.75rem;margin-top: -15px;">
                เพิ่มกลุ่ม
            </a>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                @foreach($datas as $data)
                <div class="col-xl-4 col-lg-6 col-md-12">
                    @if (Auth::user()->group_id == $data->id)
                        <a href="show-work/{{ $data->id }}">
                    @endif
                    @if (Auth::user()->status_id == '2')
                        <a href="show-work/{{ $data->id }}">
                    @endif


                        <div class="card pull-up ecom-card-1 bg-white">
                            <div class="card-content ecom-card2 height-180">
                                <h3 class="text-muted primary position-absolute p-2">{{ $data->name_group }} </h3>
                                <div>
                                    <i class="la la-users primary font-large-3 float-right p-1"></i>
                                </div>


                                <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3"><br><br>
                                    <div id="progress-stats-bar-chart">
                                        <h1 class="primary pl-5"></h1>
                                    </div>
                                    <div id="progress-stats-line-chart" class="progress-stats-shadow"></div>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>




@endsection
