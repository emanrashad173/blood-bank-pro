@extends('front.master')
@section('content')
    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
            </ol>
        </nav><!--End Breadcrumb-->
        <section class="signup-form my-4 py-4">
            <div class="my-5 text-center"><img src="{{asset('front/imgs/logo.png')}}" alt="logo"></div>
            @inject('model' ,'App\Models\Client')


            {!! Form::model($model,[
              'action' =>'Front\AuthController@loginSave',
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

              {!! Form::password('password', [
              'class' =>'form-control my-3 py-3',
              'name' => 'password',
              'id' => 'usPassword',
              'placeholder'=> 'كلمة المرور'
              ])!!}
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                <div class="form-check float-right my-4">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                    <label class="form-check-label mr-3" for="defaultCheck2">
                       تذكرنى
                    </label>
                </div>
                <div class="float-left my-4"><a href="{{url('reset-password')}}"><i class="fas fa-exclamation-triangle px-2"></i><span>هل نسيت كلمة المرور</span></a></div>
                <div class="clr"></div>
                <div class="form-row my-4">
                    <div class="col">
                        <button type="submit" class="form-control py-3 bg-success text-white">دخول</button>
                    </div>

                    <div class="col">
                        <a href="{{url('client-register')}}" type="submit" class="form-control text-center py-3 bg">انشاء حساب جديد</a>
                    </div>
                </div>
                {!! Form::close() !!}
        </section>
    </div>
    @endsection
