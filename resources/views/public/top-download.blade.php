@extends('layouts.test2')

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

    </style>

    <body>

        <div class="container">
            <section id="header-footer">
                <h1 class="display-6">Top Downloads</h1>
                <div class="row match-height">

                    <div class="col-md-4 mt-3 text-center">
                        <img src="..." alt="" width="180" height="220">
                        <h1>Title</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur ad tenetur iste officiis neque molestiae consequuntur saepe! Iusto voluptatibus sit, consequatur voluptatem eos, fugit pariatur illum, vitae error quisquam ut.</p>
                        <a href="" type="button" class="btn btn-dark">View</a>
                    </div>
                    <div class="col-md-4 mt-3 text-center">
                        <img src="..." alt="" width="180" height="220">
                        <h1>Title</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur ad tenetur iste officiis neque molestiae consequuntur saepe! Iusto voluptatibus sit, consequatur voluptatem eos, fugit pariatur illum, vitae error quisquam ut.</p>
                        <a href="" type="button" class="btn btn-dark">View</a>
                    </div>
                    <div class="col-md-4 mt-3 text-center">
                        <img src="..." alt="" width="180" height="220">
                        <h1>Title</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur ad tenetur iste officiis neque molestiae consequuntur saepe! Iusto voluptatibus sit, consequatur voluptatem eos, fugit pariatur illum, vitae error quisquam ut.</p>
                        <a href="" type="button" class="btn btn-dark">View</a>
                    </div>
                </div>
            </section>
        </div>


    </body>


@endsection


