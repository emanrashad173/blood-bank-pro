@extends('front.master')
@section('content')

        <!--main-header-->
        <div class="main-header">
            <div class="slide">
                <img src="{{asset('front/imgs/header.jpg')}}" class="d-block w-100" alt="...">
                <div class="slick-caption">
                    <h4 class="my-md-3">بنك الدم نمضى قدما لصحة أفضل</h4>
                    <p class="pl-md-5">هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد
                        النص
                        العرب</p>
                    <a href="{{url('/about')}}"><button class="btn bg px-5">المزيد</button></a>
                </div>
            </div>
            <div class="slide">
                <img src="{{asset('front/imgs/header.jpg')}}" class="d-block w-100" alt="...">
                <div class="slick-caption">
                    <h4 class="my-md-3">بنك الدم نمضى قدما لصحة أفضل</h4>
                    <p class="pl-md-5">هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد
                        النص
                        العرب</p>
                    <a href="{{url('/about')}}"><button class="btn bg px-5">المزيد</button></a>
                </div>
            </div>
            <div class="slide">
                <img src="{{asset('front/imgs/header.jpg')}}" class="d-block w-100" alt="...">
                <div class="slick-caption">
                    <h4 class="my-md-3">بنك الدم نمضى قدما لصحة أفضل</h4>
                    <p class="pl-md-5">هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد
                        النص
                        العرب</p>
                    <a href="{{url('/about')}}"><button class="btn bg px-5">المزيد</button></a>
                </div>
            </div>
        </div>
        <!--End main-header-->
    </section>
    <!--End Header-->
    <!--About section-->
    <section class="about py-5">
        <div class="container">
            <div class="about-cont py-3">
                <p class="pl-4"><span> بنك الدم</span> {{$settings->intro_app}}
                </p>
            </div>
        </div>
        <!--End container-->
    </section>
    <!--End About-->
    <!--Articles section-->
    <section class="articles py-5">
        <div class="title">
            <div class="container">
                <h2><span class="py-1">المقالات</span> </h2>
            </div>
            <hr />
        </div>
        <div class="article-slide mt-3">
            <div class="container">
                <div class="arrow text-left">
                    <button type="button" class="prev-arrow px-2 py-1"><i class="fas fa-chevron-right"></i></button>
                    <button type="button" class="next-arrow px-2 py-1"><i class="fas fa-chevron-left"></i></button>
                </div>
                <div class="slick2">
                  @foreach($posts as $post)
                    <div class="slick-cont">
                        <div class="card test">
                            <img src="{{asset($post->image)}}" class="card-img-top" alt="slick-img">
                            <div  data-id="{{$post->id}}" class="heart-icon {{$post->is_favourite ? 'second-heart' : 'first-heart'}}" onclick="toggleFavourite(this)">
                              <i class=" far fa-heart"></i>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">{{$post->title}}</h5>
                                <p>{{$post->content}}</p>
                                <div class="text-center"><a href="{{url('post/'.$post->id)}}" class="btn bg px-5">التفاصيل</a></div>
                            </div>
                        </div>
                    </div>
                   @endforeach
                </div>
            </div>
        </div>
        <!--End container-->
    </section>
    <!--End Articles-->
    <!--Donation-->
    <section class="donation">
        <h2 class="text-center"><span class="py-1">طلبات التبرع</span> </h2>
        <hr />
        <div class="donation-request py-5">
            <div class="container">
              {!! Form::open(['method'=>'GET','action'=>'Front\MainController@home','role'=>'search'])  !!}

                <div class="selection w-75 d-flex mx-auto my-4">
                  {!! Form::select('city_id',App\Models\City::pluck('name','id')->toArray(),request('city_id'),[
                    'class' => 'form-control',
                    'placeholder' => 'اختر المدينة'
                    ])!!}
                    {!! Form::select('blood_type_id',App\Models\BloodType::pluck('name','id')->toArray(),request('blood_type_id'),[
                    'class' => 'form-control',
                    'placeholder' => 'اختر الفصيله'
                    ])!!}
                    <button type="submit" style="border:none; background-color:transparent;" ><i class="fas fa-search"></i> </button>

                <!-- <div><i class="fas fa-search"></i></div> -->
                </div>
                {!! Form::close()!!}

                <!--End selection-->
                @foreach($donations as $donation)
                <div class="req-item my-3">
                    <div class="row">
                        <div class="col-md-9 col-sm-12 clearfix">
                            <div class="blood-type m-1 float-right">
                                <h3>{{$donation->bloodType->name}}</h3>
                            </div>
                            <div class="mx-3 float-right pt-md-2">
                                <p>
                                  اسم الحالة :{{$donation->patient_name}}
                                </p>
                                <p>
                                    مستشفى : {{$donation->hospital_name}}
                                </p>
                                <p>
                                    المدينة : {{$donation->city->name}}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 text-center p-sm-3 pt-md-5">
                            <a href="{{url('donation/'.$donation->id)}}" class="btn btn-light px-5 py-3">التفاصيل</a>
                        </div>
                    </div>
                </div>
                @endforeach

              <!--End last req-item-->
            </div><!--End container-->
        </div><!--End Donation-request-->
    </section>
    <!--End Donation-->
    <!--Contact-us-->
    <section class="contact-us py-5 mt-4">
        <div class="container">
            <div class="row">
                <div class="contact-info col-md-6 col-sm-12 text-center">
                    <h4 class="text-center"><span class="brd">اتصل بنا </span> </h4>
                    <p class="my-5">يمكنك الأتصال بنا للاستفسار عن معلومة وسيتم الرد عليكم</p>
                    <div class="phone-nm mx-auto">
                        <p class="py-3 text-right" href="">002<span class="px-3">{{$settings->whats_num}}</span>+</p>
                        <img src="{{asset('front/imgs/whats.png')}}" alt="whats-phone">
                    </div>
                </div>
            </div>
        </div>
        <!--End container-->
    </section>
    <!--End Contact-us-->
    <!--blood-app-->
    <section class="blood-app py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="mt-5 mb-4">تطبيق بنك الدم</h4>
                    <p class="appText">هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد
                        النص
                        العرب</p>
                    <div class="text-center avilb">
                        <h5 class="my-4">متوفر على</h5>
                        <img src="imgs/google.png" alt="">
                        <img src="{{asset('front/imgs/ios.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-6 my-3"><img src="{{asset('front/imgs/App.png')}}" class="img-fluid" alt=""></div>
            </div>
            <!--End row-->
        </div>
        <!--End container-->
    </section>
    <!--End blood-app-->

    @push('scripts')
    <script>
    function toggleFavourite(heart)
    {
      //console.log($(heart));
      var post = $(heart)
      var post_id = post.data("id");
      $.ajax({
        url : "{{url(route('toggle-favourite'))}}",
        type : 'post' ,
        data :  {_token:"{{csrf_token()}}" ,post_id:post_id},
        success : function(data){
          console.log(data);
          var currentClass =post.attr('class');
          if (currentClass.includes('first-heart'))
          {
             post.removeClass('first-heart').addClass('second-heart');
          }
          else
          {
            post.removeClass('second-heart').addClass('first-heart');

          }
        }
      });

    }
    </script>
    @endpush
  @endsection
