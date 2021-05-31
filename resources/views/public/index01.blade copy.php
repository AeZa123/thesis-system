@extends('layouts.test2')

@section('content1')



        <div class="container text-center text-white">


            <div class=" w3-animate-opacity w3-text-white ">

                    <div class="text-center">
                        <img src="{{asset('storage/img/Logo_01.png')}}" width="200px" height="auto" alt="">
                    </div>
                    <h1 class="display-4 text-center">เว็บสืบค้นปริญญานิพนธ์<br> สาขาวิศวกรรมคอมพิวเตอร์และการสื่อสาร </h1><br>
                    <h1 class=" text-center">สืบค้นปริญญานิพนธ์</h1>

                    <form method="get" action="{{ route('public-search') }}">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <div class="form-outline">
                                    <input type="search" name="search" value="{{$name}}" class="form-control mb-2" placeholder="ชื่อหนังสือ, ชื่อผู้เขียน, คีย์เวิร์ด">
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
        </div><!--container-->

        <!--modal-->
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



        <div class="container mt-5">

            <section id="header-footer">
                <div class="row match-height">
                        @foreach ($theses as $thesis)
                            <div class="col-md-4">
                                <a href="public/show/{{ $thesis->id }}">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title text-center">ปริญญานิพนธ์ :{{ $thesis->title }}</h4>
                                    </div>
                                    <div class="text-center">
                                        <img src="{{ asset('storage/img/thesis/' . $thesis->img) }}" width="150" height="180">
                                    </div>

                                    <div class="card-body">
                                        <p class="text-dark">คำอธิบาย : {{ Str::limit($thesis->description, 25) }}</p>
                                    </div>
                                    <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                        <div class="float-right">
                                            <a class="text-dark" href="public/show/{{ $thesis->id }}">อ่านเพิ่มเติม
                                                <i class="la la-angle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>

                        @endforeach

                </div>


            </section>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {!! $theses->links() !!}
            </div>

        </div>





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



@endsection
