@extends('layouts.head')

@section('content')

<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25"> <img src="{{ asset('storage/img/profile/' . $data->img) }}" class="img-radius mb-1" width="150px" alt="User-Profile-Image"></div>
                                <h6 class="f-w-600">{{ $data->name }}</h6>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">

                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="m-b-10 f-w-600">ID</p>
                                        <p class="text-muted f-w-400">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="m-b-10 f-w-600">{{ $data->id }}</p>
                                        <p class="text-muted f-w-400">{{ $data->email }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="m-b-10 f-w-600">Phone</p>
                                        <p class="text-muted f-w-400">status</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="m-b-10 f-w-600">{{ $data->phone }}</p>
                                        <p class="text-muted f-w-400">{{ $data->name_status }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="m-b-10 f-w-600">Created</p>
                                        <p class="text-muted f-w-400"></p>
                                    </div>
                                    <div class="col-sm-9 mb-2">
                                        <p class="m-b-10 f-w-600">{{ $data->created_at }}</p>
                                        <p class="text-muted f-w-400"></p>
                                    </div>
                                    <div class="col-sm-5">
                                        <a href="edit/member-profile/{{$data->id}}" id="edit-member" class="btn btn-outline-warning btn-sm">
                                        แก้ไข
                                    </a>
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
