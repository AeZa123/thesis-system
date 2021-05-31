@extends('layouts.head')

@section('content')

<div class="container">
    <h1>History Downloads</h1>

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


            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover mydatatable" >
                    <thead>
                        <tr align="center">
                            <th>id</th>
                            <th>users</th>
                            <th>title</th>
                            <th>country</th>
                            <th>date time</th>
                            <th>detail</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    @foreach ($datas as $data)
                        <!-- datas มาจากไฟล์ memberController function index.    loop ข้อมูลมาเก็บใน data -->
                        <tr align="center" id="member_id{{ $data->id }}">

                            <td>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->title }}</td>
                            <td>
                                <div class="float-left">
                                    @if ($data->name_flag == 'localhost.jpg')
                                        <img src="{{asset('storage/img/flags/'.$data->name_flag)}}" alt="" width="25px" height="25px">
                                    @endif
                                    @if ($data->name_flag != 'localhost.jpg')
                                        <img src="{{asset('storage/img/flags/'.$data->name_flag)}}" alt="" width="30px" height="19px">
                                    @endif

                                </div>
                                {{ $data->country }}
                            </td>
                            <td>
                                {{ $data->created_at }}
                            </td>
                            <td>
                                <a href="/detail/{{$data->id}}">Detail</a>
                            </td>


                            <!--modal-->

                            <td>
                                <form method="post" class="d-inline-block" action="#">
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
