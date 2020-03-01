@extends('front.master')
@section('content')

    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">الرئيسيه</a></li>
                <li class="breadcrumb-item">المفضلة</li>
            </ol>
        </nav><!--End Breadcrumb-->
    </div><!--End container-->

    <!--Articles section-->
    <section class="donation">
          <h2 class="text-center"><span class="py-1">المفضلة </span> </h2>
           <hr />
           <br>
            <div class="article-slide mt-3">
                <div class="container">


                        <div class="slick-cont">
                          @foreach($favposts as $post)

                            <div class="card">
                                <img src="{{asset($post->image)}}" class="card-img-top" alt="slick-img" >
                                <div  data-id="{{$post->id}}" class="heart-icon {{$post->is_favourite ? 'second-heart' : 'first-heart'}}" onclick="toggleFavourite(this)">
                                  <i class=" far fa-heart"></i>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{$post->title}}</h5>
                                    <p>{{$post->content}}</p>
                                    <div ><a href="{{url('post/'.$post->id)}}" class="btn bg px-5">التفاصيل</a></div>
                                </div>
                            </div>
                          </br>
                            @endforeach
                        {!! $favposts->appends(request()->query())->render() !!}
                      </div>
                    </div>
                </div>
            <!--End container-->
        </section>
        <!--End Articles-->
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
