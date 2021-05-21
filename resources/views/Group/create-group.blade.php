@extends('layouts.head')

@section('content')

<div class="container">
   <h1>สร้างกลุ่ม</h1>
   <div class="card-body">
      <form name="group" action="create-data"  method="POST">
         @csrf

         <div class="form-group row">
            <label for="name_group" class="col-md-4 col-form-label text-md-right">ชื่อโครงงาน</label>

            <div class="col-md-6">
               <input id="name_group" type="text" class="form-control @error('name_group') is-invalid @enderror" name="name_group" required autocomplete="name_group" autofocus>

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
                    <option selected="selected">select</option>
                   @foreach($users as $user)
                    <option value="{{$user->id}}" > {{ $user->name }} </option>
                   @endforeach

               </select>
            </div>
            <div class="col-md-3 mt-1 was-validated">
               <select name="author_2" class="form-control" data-live-search="true">
                    <option selected="selected">select</option>
                   @foreach($users as $user)
                    <option value="{{$user->id}}"> {{ $user->name }} </option>
                   @endforeach

               </select>
            </div>
         </div>

         <div class="form-group row">
            <label for="search" class="col-md-4 col-form-label text-md-right "></label>
            <div class="col-md-3 mt-1">
               <select name="author_3" class="selectpicker " data-live-search="true">
                    <option selected="selected" >select</option>
                  @foreach($users as $user)
                    <option value="{{$user->id}}"> {{ $user->name }} </option>
                   @endforeach

               </select>
            </div>
         </div>

         <div class="form-group row">
            <label for="search" class="col-md-4 col-form-label text-md-right ">ที่ปรึกษาหลัก</label>
            <div class="col-md-3 mt-1">
               <select name="advisor_1" class="selectpicker" data-live-search="true">
                    <option selected="selected">select</option>
                  @foreach($datas as $data)
                    <option value="{{$data->id}}"> {{ $data->name }} </option>
                  @endforeach

               </select>
            </div>
         </div>

        <div class="form-group row">
            <label for="search" class="col-md-4 col-form-label text-md-right ">ที่ปรึกษาร่วม</label>
            <div class="col-md-3 mt-1">
                <select name="advisor_2" class="selectpicker" data-live-search="true">
                    <option selected="selected">select</option>
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





<style>
   .register {

      margin-top: 3%;
      padding: 3%;
   }

   .register-left {
      text-align: center;
      color: #fff;
      margin-top: 4%;
   }

   .register-left input {
      border: none;
      border-radius: 1.5rem;
      padding: 2%;
      width: 60%;
      background: #f8f9fa;
      font-weight: bold;
      color: #383d41;
      margin-top: 30%;
      margin-bottom: 3%;
      cursor: pointer;
   }

   .register-left img {
      margin-top: 15%;
      margin-bottom: 5%;
      width: 25%;
      -webkit-animation: mover 2s infinite alternate;
      animation: mover 1s infinite alternate;
   }

   @-webkit-keyframes mover {
      0% {
         transform: translateY(0);
      }

      100% {
         transform: translateY(-20px);
      }
   }

   @keyframes mover {
      0% {
         transform: translateY(0);
      }

      100% {
         transform: translateY(-20px);
      }
   }

   .register-left p {
      font-weight: lighter;
      padding: 12%;
      margin-top: -9%;
   }

   .register .register-form {
      padding: 10%;
      margin-top: 10%;
   }

   .btnRegister {
      float: right;
      margin-top: 10%;
      border: none;
      border-radius: 1.5rem;
      padding: 2%;
      background: #0062cc;
      color: #fff;
      font-weight: 600;
      width: 50%;
      cursor: pointer;
   }

   .register .nav-tabs {
      margin-top: 3%;
      border: none;
      background: #0062cc;
      border-radius: 1.5rem;
      width: 28%;
      float: right;
   }

   .register .nav-tabs .nav-link {
      padding: 2%;
      height: 34px;
      font-weight: 600;
      color: #fff;
      border-top-right-radius: 1.5rem;
      border-bottom-right-radius: 1.5rem;
   }

   .register .nav-tabs .nav-link:hover {
      border: none;
   }

   .register .nav-tabs .nav-link.active {
      width: 100px;
      color: #0062cc;
      border: 2px solid #0062cc;
      border-top-left-radius: 1.5rem;
      border-bottom-left-radius: 1.5rem;
   }

   .register-heading {
      text-align: center;
      margin-top: 8%;
      margin-bottom: -15%;
      color: #495057;
   }
</style>
</main>


@endsection
