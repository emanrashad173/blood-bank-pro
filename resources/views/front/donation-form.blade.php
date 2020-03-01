@extends('front.master')
@section('content')
    <div class="container">
            <!--Breadcrumb-->
            <nav class="my-4" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء طلب تبرع</li>
                </ol>
            </nav><!--End Breadcrumb-->
        </div><!--End container-->
        <section class="signup ">
            <div class="container">
                <div class="py-4 mb-4">
                      @inject('model' ,'App\Models\DonationRequest')

                      {!! Form::model($model,[
                        'action' =>'Front\MainController@donationSave',
                        'method' => 'post',
                        'class'=> 'w-75 m-auto'
                        ])!!}
                          {!! Form::text('patient_name' ,null, [
                          'class' =>'form-control my-3'. ( $errors->has('patient_name') ? ' is-invalid' : '' ),
                          'name' => 'patient_name' ,
                          'placeholder' => ' اسم الحالة'
                          ])!!}
                          @error('patient_name')
                              <p class="invalid-feedback">{{ $message }}</p>

                          @enderror

                          {!! Form::text('patient_age' ,null, [
                          'class' =>'form-control my-3',
                          'name' => 'patient_age' ,
                          'placeholder' => ' عمر الحالة'
                          ])!!}
                          @error('patient_age')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror


                          @inject('blood_type','App\Models\BloodType')
                          {!!  Form::select('blood_type_id' ,$blood_type->pluck('name','id')->toArray(),null,[
                           'class' => 'form-control my-3',
                           'name' => 'blood_type_id',
                           'placeholder' => 'فصيلة الدم'
                          ]) !!}
                          @error('blood_type_id')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                          {!! Form::text('bags_num' ,null, [
                          'class' =>'form-control my-3',
                          'name' => 'bags_num' ,
                          'placeholder' => 'عدد اكياس '
                          ])!!}
                          @error('bags_num')
                              <span class="invalid-feedback" role="alert">
                                  <strong>حقل مطلوب</strong>
                              </span>
                          @enderror

                        {!! Form::text('hospital_name' ,null, [
                        'class' =>'form-control my-3',
                        'name' => 'hospital_name' ,
                        'placeholder'=> 'المستشفي'
                        ])!!}
                        @error('hospital_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        {!! Form::text('hospital_address',null, [
                        'class' =>'form-control my-3',
                        'name' => 'hospital_address',
                        'placeholder'=> 'عنوان المستشفي'
                        ])!!}
                        @error('hospital_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @inject('city','App\Models\City')
                        {!!  Form::select('city_id' ,$city->pluck('name','id')->toArray(),null,[
                         'class' => 'form-control my-3',
                         'name' => 'city_id',
                         'placeholder' => 'المدينة'
                        ]) !!}
                        @error('city_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                          {!! Form::text('phone' ,null, [
                          'class' =>'form-control my-3',
                          'name' => 'phone' ,
                          'placeholder'=> 'رقم الهاتف'
                          ])!!}
                          @error('phone')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                        <div class="text-center"><button type="submit" class="btn btn-success py-2 w-50 ">ارسال</button></div>
                    {!! Form::close() !!}
                </div>
            </div>
        </section>

@endsection
