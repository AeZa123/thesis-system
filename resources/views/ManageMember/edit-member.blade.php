@extends('layouts.head')

@section('content')

<div class="container">
    @if (session()->has('success'))
            <div class="alert alert-info">
                <h5 class="text-white">{{ session()->get('success') }}</h5>
            </div>
    @endif
    @if($errors->all())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li class="ml-2"><h5 class="text-white">{{ $error }}</h5></li>
                @endforeach
            </ul>
    @endif
    <div class="card-body">
        <form name="member_form" method="POST" action="{{ route('update-user') }}"enctype="multipart/form-data">
            <input type="hidden" name="member_id" id="member_id" value="{{$data->id}}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ $data->name }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email"
                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $data->email }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                        name="phone" value="{{ $data->phone }}" required autocomplete="phone" autofocus>

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="img" class="col-md-4 col-form-label text-md-right">Photo</label>

                <div class="col-md-6 custom-file">
                    <input class="custom-file-input" id="img" type="file" name="img" value="Photo">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>

        @if (auth()->user()->status_id == 1 or auth()->user()->status_id == 2)

            <div class="form-group row">
                <label for="search" class="col-md-4 col-form-label text-md-right ">Select status</label>
                <div class="col-md-3 mt-1">
                    <select name="status" class="selectpicker" data-live-search="true" >
                        <option selected="selected">{{$data->name_status}}</option>
                        <option>Select</option>
                        @foreach($status as $data)
                            <option >{{ $data->name_status}}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="form-group row">
                <label for="search" class="col-md-4 col-form-label text-md-right ">active status</label>
                <div class="col-md-2 mt-1">
                    <input type="radio"  name="active_status" value="กำลังศึกษา">
                    <label for="active_status" >กลังศึกษา</label><br>
                    <input type="radio"  name="active_status" value="สำเร็จการศึกษา">
                    <label for="active_status" >สำเร็จการศึกษา</label><br>
                    <input type="radio"  name="active_status" value="ออก">
                    <label for="active_status" >ออก</label><br>
                </div>
            </div>

        @endif

        <div class="form-group row">
            <label for="search" class="col-md-4 col-form-label text-md-right "></label>
            <div class="col-md-2 mt-1">
                <a href="" data-toggle="modal" data-target="#exampleModalCenter" class="">เปลี่ยนรหัสผ่าน</a>
            </div>

        </div>


            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button id="btn-save" type="submit" class="btn btn-primary">
                        {{ __('อัปเดต') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">เปลี่ยนรหัสผ่าน</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


            <form method="POST" action="{{route('update-password')}}">
                @csrf

                 @foreach ($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                 @endforeach

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                    <div class="col-md-6">
                        <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

                    <div class="col-md-6">
                        <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                    </div>
                </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">บันทึก</button>
        </div>
    </form>
      </div>
    </div>
  </div>



@endsection
