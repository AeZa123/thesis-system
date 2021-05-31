@extends('layouts.search')

@section('content1')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <style>
        body,
        h1 {
            font-family: "Raleway", sans-serif
        }

        body,
        html {
            height: 100%
        }
        .custom-select {
            position: relative;
            font-family: Arial;
        }

    </style>

    <body>


        <div class=" w3-animate-opacity w3-text-white ">

                <div class="text-center">
                    <img src="{{asset('storage/img/Logo_01.png')}}" width="200px" height="auto" alt="">
                </div>
                <h1 class="display-4 text-center">เว็บสืบค้นปริญญานิพนธ์<br> สาขาวิศวกรรมคอมพิวเตอร์และการสื่อสาร </h1><br>


                <form method="get" action="{{ route('search') }}">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <div class="form-outline">
                                <input type="search" name="search" class="form-control mb-2" placeholder="ชื่อหนังสือ, ชื่อผู้เขียน, คีย์เวิร์ด">
                            </div>
                            <div align="center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-search">ค้นหา</i>
                                </button>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg">
                                    <i class="la la-filter">กรอง</i>
                                </button>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
        </div>

        <br>
        <br class="mb-5">
        <br>
        <br>



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">


                    <p class="ml-2 mt-2">filter</p>
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-4">
                            <p>ค้นหาตามปี</p>

                            <div class="form-group col-md-7">
                                <input type="radio"  name="year" value="1">
                                <label for="">เลือกปี</label>
                                <select id="year1" class="form-control" name="year1"></select>
                            </div>


                            <div class="form-group col-md-7">
                                <input type="radio"  name="year" value="2">
                                <label for="">ปี</label>
                                <select id="year2" class="form-control" name="year2"></select>
                                ถึง
                                <label for="">ปี</label>
                                <select id="year3" class="form-control" name="year3"></select>
                            </div>

                            <div class="form-group col-md-7">
                                <input type="radio"  name="year" value="null">
                                <label for="">ไม่เลือก</label>
                            </div>

                        </div>


                        <div class="col-4">

                            <p>ค้นหาตามชื่อ</p>
                            <input type="radio"  name="year" value="3">
                            <label for="">คีย์เวิร์ด</label><br>

                            <input type="radio"  name="year" value="4">
                            <label for="">ชื่อนักศึกษา</label><br>


                        </div>

                        <div class="col-2"></div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">ตกลง</button>
                      </div>



    </div>
  </div>
</div>
</form>










    <script>
        var start = 2020;
        var end = new Date().getFullYear();
        var options = "";
        for(var year = start ; year <=end; year++){
        options += "<option>"+ year +"</option>";
        }
        document.getElementById("year1").innerHTML = options;
    </script>

    <script>
        var start = 2020;
        var end = new Date().getFullYear();
        var options = "";
        for(var year = start ; year <=end; year++){
        options += "<option>"+ year +"</option>";
        }
        document.getElementById("year2").innerHTML = options;
    </script>

    <script>
        var start = 2020;
        var end = new Date().getFullYear();
        var options = "";
        for(var year = start ; year <=end; year++){
        options += "<option>"+ year +"</option>";
        }
        document.getElementById("year3").innerHTML = options;
    </script>

    </body>


@endsection


