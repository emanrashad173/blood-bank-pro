@extends('front.master')
@section('content')
    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page"> تغيير كلمة المرور</li>
            </ol>
        </nav><!--End Breadcrumb-->
        <section class="signup-form my-4 py-4">
            <div class="my-5 text-center"><img src="{{asset('front/imgs/logo.png')}}" alt="logo"></div>
            @inject('model' ,'App\Models\Client')
            @include('partials.validation_errors')


            {!! Form::model($model,[
              'action' =>'Front\AuthController@passwordReset',
              'method' => 'post',
              'class'=> 'w-75 m-auto'
              ])!!}
              {!! Form::text('phone' ,null, [
              'class' =>'form-control my-3 py-3',
              'name' => 'phone' ,
              'id' => 'usPhone',
              'placeholder'=> 'الجوال'
              ])!!}
              @error('phone')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror

                   <div class="text-center">
                     <button type="submit" class="btn btn-success py-2 w-50">ارسال</button>
                    </div>
                </div>
                {!! Form::close() !!}
        </section>
    </div>
    @endsection
