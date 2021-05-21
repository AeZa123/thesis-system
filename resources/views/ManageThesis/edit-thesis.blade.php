@extends('layouts.head')

@section('content')

    <div class="container">
        <h1>Edit Thesis</h1>

        <div class="card-body">
            <form name="thesis" method="POST" action="{{ route('update-thesis') }}"enctype="multipart/form-data">
                <input type="hidden" name="thesis_id" value="{{$data->id}}" >
                <input type="hidden" name="user_thesis" >
                @csrf

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                    <div class="col-md-6">
                        <input id="title" type="text" value="{{$data->title}}" class="form-control @error('title') is-invalid @enderror"
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
                        <input id="description" type="description" value="{{$data->description}}" class="form-control @error('description') is-invalid @enderror"
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
                        <input id="words_search" type="text" value="{{$data->words_search}}" class="form-control @error('words_search') is-invalid @enderror"
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
                        <input value="{{$data->file_thesis}}" class="@error('file_thesis') is-invalid @enderror" id="file_thesis" type="file" name="file_thesis" >

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
                        <input value="{{$data->img}}" class="@error('img') is-invalid @enderror" id="img" type="file" name="img" >

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
                        <select name="advisor_1" class="selectpicker" data-live-search="true">
                            @if (count($name_advisor) >= 1)
                                <option selected="selected">{{ $name_advisor[0]->name}}</option>
                                <option>select</option>
                            @endif
                            @if (count($name_advisor) < 1)
                                <option selected="selected">select</option>
                            @endif
                            @foreach($advisors as $advisor)
                                <option >{{ $advisor->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mt-1">
                        <select name="advisor_2" class="selectpicker" data-live-search="true">
                            @if (count($name_advisor) == '2')
                                <option selected="selected">{{ $name_advisor[1]->name}}</option>
                                <option>select</option>
                            @endif
                            @if (count($name_advisor) < '2')
                                <option selected="selected">select</option>
                            @endif
                            @foreach($advisors as $advisor)
                                <option >{{ $advisor->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="search" class="col-md-4 col-form-label text-md-right ">ผู้เขียน</label>
                    <div class="col-md-3 mt-1">
                        <select name="author_1" class="selectpicker" data-live-search="true">
                            @if (count($name_student) >= '1')
                                <option selected="selected">{{ $name_student[0]->name}}</option>
                                <option>select</option>
                            @endif
                            @if (count($name_student) < '1')
                                <option selected="selected">select</option>
                            @endif
                            @foreach($users as $user)
                                <option >{{ $user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mt-1">
                        <select name="author_2" class="selectpicker" data-live-search="true">
                            @if (count($name_student) > '2')
                                <option selected="selected">{{ $name_student[1]->name}}</option>
                                <option>select</option>
                            @endif
                            @if (count($name_student) < '2')
                                <option selected="selected">select</option>
                            @endif
                            @foreach($users as $user)
                                <option >{{ $user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="search" class="col-md-4 col-form-label text-md-right "></label>
                    <div class="col-md-3 mt-1">
                        <select name="author_3" class="selectpicker" data-live-search="true">
                            @if (count($name_student) == '3')
                                <option selected="selected">{{ $name_student[2]->name}}</option>
                                <option>select</option>
                            @endif
                            @if (count($name_student) < '3')
                                <option selected="selected">select</option>
                            @endif
                            @foreach($users as $user)
                                <option >{{ $user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="search" class="col-md-4 col-form-label text-md-right "></label>
                    <div class="col-md-2 mt-1">
                        <input type="radio"  name="check" value="1">
                        <label for="check">ผ่าน</label><br>
                        <input type="radio"  name="check" value="2">
                        <label for="check">ไม่ผ่าน</label><br>
                    </div>
                </div>


                <div class="form-group row mb-0" align="center">
                    <div class="col-md-4 offset-md-4">
                        <button  type="submit" class="btn btn-primary width-200">
                            อัปเดต
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
