@extends('front.master')
@section('content')
    </section><!--End Header-->
    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">الاشعارات</li>
            </ol>
        </nav>
    </div><!--End container-->
    <!--Donation-->
    <section class="donation">
        <h2 class="text-center"><span class="py-1">الاشعارات</span> </h2>
        <hr />
        <div class="donation-request py-5">
            <div class="container">

                @foreach($notifications as $notification)

                <div class="req-item my-3">
                    <div class="row">
                        <div class="col-md-9 col-sm-12 clearfix">

                            <div class="mx-3 float-right pt-md-2">
                                 <h3><a class="page-link" href="{{url('/donation/'.$notification->donationRequest->id)}}">
                                    {{$notification->title}}
                                </a></h3>
                                <p>
                                    {{$notification->content}}
                                </p>

                            </div>
                        </div>

                    </div>
                </div>

                @endforeach


                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center my-3">
                        <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!--End container-->
        </div>
        <!--End Donation-request-->
    </section>
    <!--End Donation-->
@endsection
