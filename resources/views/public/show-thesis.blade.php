@extends('layouts.show-public')

@section('content1')



    <div class="container">


        <div class="row justify-content-center">
            <div class="col-1"></div>
            <div class="col-10 bg-white" style="border-radius: 5px">
                <div class="row">
                    <div class="col-4 mt-3">
                        <div class="justify-content-center text-center">
                            <img src="{{ asset('storage/img/thesis/'. $data->img) }}" alt="" width="80%" height="auto">
                        </div>

                    </div>
                    <div class="col-8 mt-3 px-5">
                        <h3>ปริญญานิพนธ์เรื่อง: {{$data->title}}</h3>
                        <h4>คำอธิบาย: {{$data->description}}</h4>
                        <h4>คำค้นหา: {{$data->words_search}}</h4>

                        @foreach ($students as $student)
                            <p>ผู้เขียน: {{$student->name}}</p>
                        @endforeach

                        @foreach ($teachers as $teacher)
                            <p>ที่ปรึกษา: {{$teacher->name}}</p>
                        @endforeach

                        <p>วันอัปเล่ม: {{$data->created_at}}</p>


                        <a href="/download/thesis/{{ $data->file_thesis }}" class="btn btn-info mb-2">ดาวน์โหลด</a> (กรุณาล็อกอินก่อนนะครับ)
                    </div>
                </div>


            </div>
            <div class="col-1"></div>
        </div>


    </div>





@endsection
