@extends('layouts.head')

@section('content')
<h1>ปริญญานิพนธ์เรื่อง</h1><br>

<div class="container">
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

            <p>ปีที่อัพโหลด: {{$data->created_at}}</p>




            <a href="/download/thesis/{{ $data->file_thesis }}" class="btn btn-info mb-2">ดาวน์โหลด</a>

            @if($data->status == '0')

                <form action="{{route('check-thesis')}}" method="post">
                    @csrf
                    <input type="hidden" name="check" value="ผ่าน">
                    <input type="hidden" name="thesis_id" value="{{$data->id}}">

                    <button type="submit" class="btn btn-primary mr-1">ผ่าน</button>
                    <a class="btn btn-danger text-white" data-toggle="modal" data-target="#exampleModalCenter">ไม่ผ่าน</a>

                </form>

            @endif

        </div>
    </div>
</div>



  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">ความคิดเห็น</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form action="{{route('check-thesis')}}" method="POST">
                @csrf
                <input type="hidden" name="check" value="ไม่ผ่าน">
                <input type="hidden" name="thesis_id" value="{{$data->id}}">
                <textarea name="comment" cols="60" rows="5" placeholder="ออกความคิดเห็น"></textarea>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">ยืนยัน</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>




      </div>
    </div>
  </div>









@endsection
