@extends('layouts.head')

@section('content')

<div class="container">
    <h1>สั่งงาน</h1>

    <form action="{{ route('addWork') }}" method="POST" enctype="multipart/form-data">

        @csrf
        <input type="hidden" name="group_id" value="{{$data}}">

        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                    name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

            <div class="col-md-6">
                <textarea class="form-control" rows="3" cols="30%" name="description" ></textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="file" class="col-md-4 col-form-label text-md-right">เอกสารประกอบ</label>

            <div class="col-md-6">
                <input type="file" name="document1" value="document">
            </div>
        </div>
        <div class="form-group row">
            <label for="file" class="col-md-4 col-form-label text-md-right"></label>

            <div class="col-md-6">
                <input type="file" name="document2" value="document">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button id="btn-save" type="submit" class="btn btn-primary">
                    {{ __('สั่งงาน') }}
                </button>
            </div>
        </div>


    </form>





</div>


@endsection
