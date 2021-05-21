@extends('layouts.head')

@section('content')

<div class="container">
    <div class="card-body">
        <form name="member_form" method="POST" action="{{ route('create') }}"enctype="multipart/form-data">
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

                <div class="col-md-6">
                    <input id="img" type="file" name="img" value="Photo">
                </div>
            </div>

        @if (auth()->user()->status_id == 1 or auth()->user()->status_id == 2)

            <div class="form-group row">
                <label for="search" class="col-md-4 col-form-label text-md-right ">Select status</label>
                <div class="col-md-3 mt-1">
                    <select name="status" class="selectpicker" data-live-search="true" >
                        <option selected="selected">Select</option>
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
                <label for="password"
                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password"
                        required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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

@endsection
