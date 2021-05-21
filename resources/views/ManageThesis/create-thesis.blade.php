@extends('layouts.head')

@section('content')

    <div class="container">
        <h1>Create Thesis</h1>
        @if($errors->all())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        @endif

        <div class="card-body">
            <form name="thesis" method="POST" action="{{ route('create-thesis') }}"enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                @csrf

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                            name="title"  required autocomplete="name" autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description"
                        class="col-md-4 col-form-label text-md-right">description</label>

                    <div class="col-md-6">
                        <input id="description" type="description" class="form-control @error('description') is-invalid @enderror"
                            name="description" required autocomplete="description" autofocus>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="words_search" class="col-md-4 col-form-label text-md-right">Keywords</label>

                    <div class="col-md-6">
                        <input id="words_search" type="text" class="form-control @error('words_search') is-invalid @enderror"
                            name="words_search" required autocomplete="phone" autofocus>

                        @error('words_search')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="file_thesis" class="col-md-4 col-form-label text-md-right">File</label>


                    <div class="col-md-6">

                        <div class="custom-file">
                            <input  type="file" class="custom-file-input" id="file_thesis" name="file_thesis" value="file">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>

                        @error('file_thesis')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="img" class="col-md-4 col-form-label text-md-right">Photo</label>

                    <div class="col-md-6">
                        <div class="custom-file">
                            <input  type="file" class="custom-file-input" id="img" name="img" value="img">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>

                        @error('img')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="search" class="col-md-4 col-form-label text-md-right ">ที่ปรึกษา</label>
                    <div class="col-md-3 mt-1">
                        <select name="advisor_1" class="selectpicker" data-live-search="true" >
                            <option selected="selected">select</option>
                            @foreach($datas as $data)
                                <option >{{ $data->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mt-1">
                        <select name="advisor_2" class="selectpicker" data-live-search="true">
                            <option selected="selected">select</option>
                            @foreach($datas as $data)
                                <option >{{ $data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="search" class="col-md-4 col-form-label text-md-right ">ผู้เขียน</label>
                    <div class="col-md-3 mt-1">
                        <select name="author_1" class="selectpicker" data-live-search="true">
                            <option selected="selected">select</option>
                            @foreach($users as $data)
                                <option >{{ $data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mt-1">
                        <select name="author_2" class="selectpicker" data-live-search="true">
                            <option selected="selected">select</option>
                            @foreach($users as $data)
                                <option >{{ $data->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="form-group row">
                    <label for="search" class="col-md-4 col-form-label text-md-right "></label>
                    <div class="col-md-3 mt-1">
                        <select name="author_3" class="selectpicker" data-live-search="true">
                            <option selected="selected">select</option>
                            @foreach($users as $data)
                                <option >{{ $data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-0" align="center">
                    <div class="col-md-4 offset-md-4">
                        <button  type="submit" class="btn btn-primary width-200">
                            เพิ่ม
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
