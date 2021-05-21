@extends('layouts.head')


@section('content')

    <div class="container">
        <h1>Manage Groups</h1>
    </div>

    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-dark">
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif

        <div id="app">

            <div class="card mb-3">
                <div class="card-header">

                    <div class="pull-right">
                        <a class="btn btn-dark" href="{{ route('create-group') }}" >
                            เพิ่มกลุ่มโครงงาน
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover mydatatable" >
                        <thead>
                            <tr align="center">
                                <th scope="col">id</th>
                                <th scope="col">Project</th>

                                <th scope="col">status</th>
                                <th scope="col">Active</th>
                            </tr>
                        </thead>

                        @foreach($datas as $data)

                            <!-- datas มาจากไฟล์ memberController function index.    loop ข้อมูลมาเก็บใน data -->

                            <tr align="center" id="member_id">


                                <td>{{ $data->id }}</td>
                                <td>
                                    <a href="show-work/{{ $data->id }}">{{$data->name_group}}</a>
                                </td>

                                <td></td>

                                <!--modal-->

                                <td>
                                    <a href="edit-group/{{ $data->id }}"  class="btn btn-outline-warning btn-sm">
                                        แก้ไข
                                    </a>
                                    <form method="post" class="d-inline-block" action="{{ route('delete-group') }}">
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
