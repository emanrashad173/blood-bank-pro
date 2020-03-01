@extends('front.master')
@section('content')
    <div class="container">
            <!--Breadcrumb-->
            <nav class="my-4" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                </ol>
            </nav><!--End Breadcrumb-->
        </div><!--End container-->
        <section class="signup text-center">
            <div class="container">
                <div class="py-4 mb-4">
                      @include('partials.validation_errors')
                      @inject('model' ,'App\Models\Client')

                      {!! Form::model($model,[
                        'action' =>'Front\AuthController@registerSave',
                        'method' => 'post',
                        'class'=> 'w-75 m-auto'
                        ])!!}
                          {!! Form::text('name' ,null, [
                          'class' =>'form-control my-3',
                          'name' => 'name' ,
                          'placeholder' => 'الاسم'
                          ])!!}
                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                          {!! Form::text('email' ,null, [
                          'class' =>'form-control my-3',
                          'name' => 'email' ,
                          'placeholder' => ' البريد الاليكتروني'
                          ])!!}
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                          {!! Form::text('dob' ,null, [
                          'class' =>'form-control my-3',
                          'name' => 'dob' ,
                          'placeholder' => 'تاريخ الميلاد'
                          ])!!}
                          @error('dob')
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


                        @inject('governorate','App\Models\Governorate')
                        {!!  Form::select('governorate_id' ,$governorate->pluck('name','id')->toArray(),null,[
                         'class' => 'form-control my-3',
                         'id' => 'capital',
                         'name' => 'capital',
                         'placeholder' => 'اختر المحافظة'
                        ]) !!}
                        @error('governorate_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        {!!  Form::select('city_id' ,[],null,[
                         'class' => 'form-control my-3',
                         'id' => 'city',
                         'name' => 'city_id',
                         'placeholder' => 'اختار مدينة'
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

                          {!! Form::text('last_donation_date' ,null, [
                          'class' =>'form-control my-3',
                          'name' => 'last_donation_date' ,
                          'placeholder'=> 'اخر تبرع'
                          ])!!}
                          @error('last_donation_date')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                          {!! Form::password('password', [
                          'class' =>'form-control my-3',
                          'name' => 'password',
                          'placeholder'=> 'كلمة المرور'
                          ])!!}
                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                          {!! Form::password('password_confirmation' , [
                          'class' =>'form-control my-3',
                          'name' => 'rePass',
                          'placeholder'=> '  تاكيد كلمة المرور '
                          ])!!}
                          @error('password_confirmation')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                        <button type="submit" class="btn btn-success py-2 w-50">ارسال</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
        @push('scripts')
        <script>
        //event for change
        $("#capital").change(function(e){
          e.preventDefault();

        //get gov
        var governorate_id = $("#capital").val();
        if(governorate_id)
        {

          //send ajax
           $.ajax({
             url : '{{url('api/v1/cities?governorate_id=')}}'+governorate_id,
             type : 'get',
             success: function(data){
               if(data.status==1)
               {
                 $('#city').empty();
                 $("#city").append('<option value=""> اختر مدينة</option>')
                 $.each(data.data,function(index,city){
                   $("#city").append('<option value="'+city.id+'">'+city.name+'</option>')
                 })
                 // console.log(data);
               }

             },
             error: function(jqXhr, textStatus, errorMessage){
               alert(errorMessage);
             }
           });
        }
        else{
          $('#city').empty();
          $("#city").append('<option value=""> اختر مدينة</option>')
        }
        });
        </script>
        @endpush
@endsection
