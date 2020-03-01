@extends('front.master')
@section('content')
    </section><!--End Header-->
    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
            </ol>
        </nav>
     </div><!--End container-->
    <!--Donation-->
    <section class="donation">
        <h2 class="text-center"><span class="py-1">طلبات التبرع</span> </h2>
        <hr />
        <div class="donation-request py-5">
            <div class="container">
              {!! Form::open(['method'=>'GET','action'=>'Front\MainController@donations','role'=>'search'])  !!}

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
                                <h3><span dir="ltr">{{optional($donation->bloodType)->name}}</span></h3>
                            </div>
                            <div class="mx-3 float-right pt-md-2">
                                <p>
                                    اسم الحالة : {{$donation->patient_name}}
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

                {!! $donations->appends(request()->query())->render() !!}
            </div>
            <!--End container-->
        </div>
        <!--End Donation-request-->
    </section>
    <!--End Donation-->
@endsection
