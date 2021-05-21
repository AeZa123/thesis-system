@extends('layouts.head')
@section('content')

<div class="container">
    <h1>แก้ไขกลุ่มโครงงาน</h1>
    <div class="card-body">
       <form name="group" action="{{ route('editSave') }}"  method="POST">
          @csrf
          <input type="hidden" value="{{$group->id}}" name="group_id">

          <div class="form-group row">
             <label for="name_group" class="col-md-4 col-form-label text-md-right">ชื่อโครงงาน</label>

             <div class="col-md-6">
                <input id="name_group" type="text" value="{{$group->name_group}}" class="form-control @error('name_group') is-invalid @enderror" name="name_group" required autocomplete="name_group" autofocus>

                @error('name_group')
                <span class="invalid-feedback" role="alert">
                   <strong></strong>
                </span>
                @enderror
             </div>
          </div>

          <div class="form-group row">
             <label for="search" class="col-md-4 col-form-label text-md-right ">สมาชิกในกลุ่ม</label>
             <div class="col-md-3 mt-1">
                <select name="author_1" class="selectpicker" data-live-search="true">
                    <option >Select</option>
                    <option selected="selected">{{$student1->name}}</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{ $user->name }} </option>
                    @endforeach

                </select>
             </div>

            <div class="col-md-3 mt-1">
                <select name="author_2" class="selectpicker" data-live-search="true">
                    <option >Select</option>
                    <option selected="selected">

                        @if ($student2 == 'select')
                            select
                        @else
                            {{$student2->name}}
                        @endif

                    </option>

                    @foreach($users as $user)
                        <option> {{ $user->name }} </option>
                    @endforeach
                </select>
            </div>

          </div>

          <div class="form-group row">
             <label for="search" class="col-md-4 col-form-label text-md-right "></label>

            <div class="col-md-3 mt-1">
                <select name="author_3" class="selectpicker" data-live-search="true">
                    <option >Select</option>
                    <option selected="selected">

                        @if ($student3 == 'select')
                            select
                        @else
                            {{$student3->name}}
                        @endif

                    </option>
                @foreach($users as $user)
                    <option> {{ $user->name }} </option>
                @endforeach

                </select>
            </div>


          </div>

          <div class="form-group row">
             <label for="search" class="col-md-4 col-form-label text-md-right ">ที่ปรึกษา</label>
             <div class="col-md-3 mt-1">
                <select name="advisor_1" class="selectpicker" data-live-search="true">
                    <option >Select</option>
                    <option selected="selected">{{$teacher1->name}}</option>
                   @foreach($datas as $data)
                     <option value="{{$data->id}}"> {{ $data->name }} </option>
                   @endforeach

                </select>
             </div>

             <div class="col-md-3 mt-1">
                <select name="advisor_2" class="selectpicker" data-live-search="true">
                    <option >Select</option>
                    <option selected="selected">

                        @if ($teacher2 == null)
                            select
                        @else
                            {{$teacher2->name}}
                        @endif

                    </option>
                   @foreach($datas as $data)
                     <option value="{{$data->id}}"> {{ $data->name }} </option>
                   @endforeach

                </select>
             </div>
          </div>

          <div class="form-group row mb-0" align="center">
             <div class="col-md-4 offset-md-4">
                <button type="submit" class="btn btn-primary width-200">
                   เพิ่ม
                </button>
             </div>
          </div>

       </form>
    </div>
 </div>

@endsection
