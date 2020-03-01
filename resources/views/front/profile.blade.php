@extends('front.master')
@section('content')
    <div class="container">
            <!--Breadcrumb-->
            <nav class="my-4" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تعديل الحساب </li>
                </ol>
            </nav><!--End Breadcrumb-->
        </div><!--End container-->
        <section class="signup text-center">
            <div class="container">
                <div class="py-4 mb-4">
                      @include('partials.validation_errors')
                      @inject('model' ,'App\Models\Client')

                      {!! Form::model($model,[
                        'action' =>['Front\AuthController@profileSet',$model->id],
                        'method' => 'post',
                        'class'=> 'w-75 m-auto'
                        ])!!}
                          {!! Form::text('name',auth()->user()->name, [
                          'class' =>'form-control my-3',
                          'name' => 'name' ,
                          'placeholder' => 'الاسم'
                          ])!!}

                          {!! Form::text('email' ,auth()->user()->email, [
                          'class' =>'form-control my-3',
                          'name' => 'email' ,
                          'placeholder' => ' البريد الاليكتروني'
                          ])!!}

                          {!! Form::date('dob' ,auth()->user()->dob, [
                          'class' =>'form-control my-3',
                          'name' => 'dob' ,
                          'placeholder' => 'تاريخ الميلاد'
                          ])!!}

                          {!! Form::text('blood_type_id' ,auth()->user()->blood_type_id, [
                          'class' =>'form-control my-3',
                          'name' => 'blood_type_id' ,
                          'placeholder' => 'فصيلة الدم'
                          ])!!}

                        @inject('governorate','App\Models\Governorate')
                        {!!  Form::select('governorate_id' ,$governorate->pluck('name','id')->toArray(),null,[
                         'class' => 'form-control my-3',
                         'id' => 'capital',
                         'name' => 'capital',
                         'placeholder' => 'اختر المحافظة'
                        ]) !!}

                        {!!  Form::select('city_id' ,[],null,[
                         'class' => 'form-control my-3',
                         'id' => 'city',
                         'name' => 'city_id',
                         'placeholder' => 'اختار مدينة'
                        ]) !!}

                          {!! Form::text('phone' ,auth()->user()->phone, [
                          'class' =>'form-control my-3',
                          'name' => 'phone' ,
                          'placeholder'=> 'رقم الهاتف'

                          ])!!}

                          {!! Form::date('last_donation_date' ,auth()->user()->last_donation_date, [
                          'class' =>'form-control my-3',
                          'name' => 'last_donation_date' ,
                          'placeholder'=> 'اخر تبرع'
                          ])!!}

                          {!! Form::password('password', [
                          'class' =>'form-control my-3',
                          'name' => 'password',
                          'placeholder'=> 'كلمة المرور'
                          ])!!}

                          {!! Form::password('password_confirmation' , [
                          'class' =>'form-control my-3',
                          'name' => 'rePass',
                          'placeholder'=> '  تاكيد كلمة المرور '
                          ])!!}
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
