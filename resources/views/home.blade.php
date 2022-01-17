@extends('layouts.app')


@section('content')



<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
             <!-- eCommerce statistic -->
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-12">
                    <a href="{{route('managemember')}}">
                    <div class="card pull-up ecom-card-1 bg-white">
                        <div class="card-content ecom-card2 height-180">
                            <h3 class="text-muted danger position-absolute p-2">สมาชิก</h3>
                            <div>
                                <i class="la la-user danger font-large-3 float-right p-1"></i>
                            </div>


                            <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3"><br><br>
                            <div id="progress-stats-bar-chart"><h1 class="danger pl-5">{{ $member }}</h1></div>
                                <div id="progress-stats-line-chart" class="progress-stats-shadow"></div>

                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                    <a href="{{route('theses')}}">
                    <div class="card pull-up ecom-card-1 bg-white">
                        <div class="card-content ecom-card2 height-180">
                            <h3 class="text-muted info position-absolute p-2">ปริญญานิพนธ์</h3>
                            <div>
                                <i class="la la-book info font-large-3 float-right p-1"></i>
                            </div>
                            <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3"><br><br>
                                <div id="progress-stats-bar-chart1"><h1 class="info pl-5">{{$thesis}}</h1></div>
                                <div id="progress-stats-line-chart1" class="progress-stats-shadow"></div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-6 col-lg-12">
                    <a href="{{route('history-download')}}">
                    <div class="card pull-up ecom-card-1 bg-white">
                        <div class="card-content ecom-card2 height-180">
                            <h3 class="text-muted warning position-absolute p-2">ดาวน์โหลด</h3>
                            <div>
                                <i class="la la-cloud-download warning font-large-3 float-right p-1"></i>
                            </div>
                            <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3"><br><br>
                                <div id="progress-stats-bar-chart2"><h1 class="warning pl-5">{{$download}}</h1></div>
                                <div id="progress-stats-line-chart2" class="progress-stats-shadow"></div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-xl-3 col-lg-6 col-lg-12">
                    <a href="{{route('manage-group')}}">
                    <div class="card pull-up ecom-card-1 bg-white">
                        <div class="card-content ecom-card2 height-180">
                            <h3 class="text-muted primary position-absolute p-2">กลุ่มโครงงาน</h3>
                            <div>
                                <i class="la la-users primary font-large-3 float-right p-1"></i>
                            </div>
                            <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3"><br><br>
                                <div id="progress-stats-bar-chart2"><h1 class="primary pl-5">{{$group}}</h1></div>
                                <div id="progress-stats-line-chart2" class="progress-stats-shadow"></div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

            </div>
            <!--/ eCommerce statistic -->
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
