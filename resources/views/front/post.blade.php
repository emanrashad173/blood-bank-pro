@extends('front.master')
@section('content')

    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">الرئيسيه</a></li>
                <li class="breadcrumb-item"><a href="#">المقالات</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{$post->title}}</li>
            </ol>
        </nav><!--End Breadcrumb-->
    </div><!--End container-->
    <section class="artice-detailes pb-5">
        <div class="container">
            <div class="article-img m-auto">
                <img src="{{asset($post->image)}}" class="card-img-top" alt="article-img">
            </div>
            <div class="article-content my-4">
                <div class="article-header p-2 d-flex justify-content-between">
                    <h6>{{$post->title}}</h6>
                    <a href=""><i class="far fa-heart"></i></a>
                </div>
                <div class="article-details p-4">
                    <p class="my-md-4">{{$post->content}} </p>
                    <p class="my-md-4"> {{$post->content}} </p>
                </div>
            </div>
        </div>
    </section>
    <!--Articles section-->
    <section class="articles mb-5">
            <div class="title">
                <div class="container">
                    <h5><span class="py-1">مقالات ذات صلة</span> </h5>
                </div>
            </div>
      @yield('posts')
            <!--End container-->
        </section>
        <!--End Articles-->
@endsection
