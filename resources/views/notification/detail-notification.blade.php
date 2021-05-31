@extends('layouts.notification')



@section('content')

        @if($errors->all())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        @endif
<!-- Card Headings section start -->
<section id="card-headings">
	<div class="row">

        <div class="col-md-3"></div>

		<div class="col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="heading-multiple-thumbnails">ชื่อกลุ่ม {{$name_group->name_group}} </h4>
				</div>
				<div class="card-content">
					<div class="card-body ml-3">
                        <h4 class="card-title">สมาชิก</h4>
                        @foreach ($name as $data)

                            @if ($data->status_id == 2)
                                <p class="card-text">อาจารย์ที่ปรึกษา {{$data->name}}</p>
                            @endif

                            @if ($data->status_id != 2)
                                <p class="card-text">นักศึกษา {{$data->name}}</p>
                            @endif

                        @endforeach
					</div>
                    @if (Auth::user()->status_id == '2')
                        <form action="{{route('confirm-group')}}" method="POST" class="ml-3">
                            @csrf

                            @if ($name_group->id != NULL)
                                <input type="hidden" name="group_id" value="{{$name_group->id}}">
                            @endif

                            <div class="form-group col-md-7">
                                <input type="radio"  name="confirm" value="ผ่าน">
                                <label for="">อนุญาตสร้างกลุ่ม</label><br>
                                <input type="radio"  name="confirm" value="ไม่ผ่าน">
                                <label for="">ไม่อนุญาต</label>
                            </div>

                            <button type="submit" class="btn btn-primary mb-2 mr-2 float-right">ยืนยันการสร้าง</button>
                        </form>
                    @endif


				</div>
			</div>
		</div>

        <div class="col-md-3"></div>

	</div>

</section>
<!-- // Card Headings section end -->


@endsection
