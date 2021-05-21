@extends('layouts.head')


@section('content')
<div class="container">
    <h1>thesis</h1>

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
                    <a class="btn btn-dark" href="{{ route('createthesis') }}" >
                        เพิ่มปริญญานิพนธ์
                    </a>

                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover mydatatable" >
                    <thead>
                        <tr align="center">
                            <th>id</th>
                            <th>title</th>
                            <th>description</th>
                            <th>status</th>
                            <th>Active</th>
                        </tr>
                    </thead>

                    @foreach ($datas as $data)
                        <!-- datas มาจากไฟล์ memberController function index.    loop ข้อมูลมาเก็บใน data -->
                        <tr align="center" id="member_id{{ $data->id }}">

                            <td>{{ $data->id }}</td>
                            <td>
                                <a href="/show/{{ $data->id }}">{{ $data->title }}</a>
                            </td>
                            <td>
                                {{ Str::limit($data->description, 30) }}
                            </td>
                            @if($data->status == null)
                                <td>
                                    <input type="hidden" value="{{ $data->status }}">
                                    <p>รอการตรวจ</p>
                                </td>
                            @endif
                            @if($data->status == 1)
                                <td>
                                    <input type="hidden" value="{{ $data->status }}">
                                    <p>ผ่าน</p>
                                </td>
                            @endif
                            @if($data->status == 2)
                                <td>
                                    <input type="hidden" value="{{ $data->status }}">
                                    <p>ไม่ผ่าน</p>
                                </td>
                            @endif


                            <!--modal-->

                            <td>
                                <a href="/edit/thesis/{{ $data->id }}"  class="btn btn-outline-warning btn-sm">
                                    แก้ไข
                                </a>
                                <form method="post" class="d-inline-block" action="{{ route('delete-thesis') }}">
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
