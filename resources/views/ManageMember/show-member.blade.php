@extends('layouts.head')



@section('content')

    <div class="container">
        <h1>Show Member</h1>
    </div>

    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-info">
                <h4 class="text-white">{{ session()->get('success') }}</h4>
            </div>
        @endif

        <div id="app">

            <div class="card mb-3">
                <div class="card-header">
                    <!--
                    <div class="pull-left">
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>

                    <button class="btn btn-primary ml-1">search</button>
                    -->
                    <div class="pull-right">
                        <a class="btn btn-dark" href="{{route('add-member')}}" >
                            เพิ่มสมาชิก
                        </a>
                    </div>
                    <div class="pull-right mr-1">
                        <a class="btn btn-dark" href="{{ route('export-excel') }}" >
                            Export Excel
                        </a>
                    </div>
                    <div class="pull-right mr-1">
                        <a class="btn btn-dark" href="{{ route('export-csv') }}" >
                            Export File CSV
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover mydatatable" style="width: 100%">
                        <thead>
                            <tr align="center">
                                <th scope="col">id</th>
                                <th scope="col">name</th>
                                <th scope="col">email</th>
                                <th scope="col">status</th>
                                <th scope="col">Active</th>
                            </tr>
                        </thead>

                        @foreach ($datas as $data)
                            <!-- datas มาจากไฟล์ memberController function index.    loop ข้อมูลมาเก็บใน data -->

                            <tr align="center" id="member_id{{ $data->id }}">


                                <td>{{ $data->id }}</td>
                                <td>
                                    <a href="/profile/member/{{ $data->id }}">{{ $data->name }}</a>
                                </td>
                                <td>
                                    <a href="/profile/member/{{ $data->id }}">{{ $data->email }}</a>
                                </td>
                                <td>{{ $data->name_status }}</td>

                                <!--modal-->

                                <td>
                                    <a href="/edit/member/{{ $data->id }}"  class="btn btn-outline-warning btn-sm">
                                        แก้ไข
                                    </a>
                                    <form method="post" class="d-inline-block" action="{{ route('delete-member') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <input type="hidden" name="delete" value="DELETE">
                                        <button type="submit" role="button" class="btn btn-outline-danger btn-sm btn-delete"
                                            onclick="return confirm('คุณต้องการลบข้อมูลที่เลือกหรือไม่ ?')">ลบ</button>
                                    </form>
                                </td>

                            </tr>

                        @endforeach
                    </table>

                </div>
            </div>

        </div>
    </div>



@endsection
