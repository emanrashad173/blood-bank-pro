@extends('layouts.admin-app')
@section('content')
@inject('model','App\User')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Admin</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active">Change Password</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">


  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Admin Change Password</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
      @include('partials.validation_errors')

      {!! Form::model($model,[
        'action' => ['UserController@updatePassword',$model->id],
        'method' => 'post'
        ])!!}
      <div class="form-group">
        <label for="old_password">Old Password</label>
        {!! Form::password('old_password', [
        'class' =>'form-control'
        ])!!}
      </div>
      <div class="form-group">
        <label for="new_password">New Password</label>
        {!! Form::password('password', [
        'class' =>'form-control'
        ])!!}
      </div>
      <div class="form-group">
        <label for="password_confirmation">New Password_Confirmation</label>
        {!! Form::password('password_confirmation' , [
        'class' =>'form-control'
        ])!!}
      </div>

      <div class="form-group">
        <button class="btn btn-primary" type="submit">update</button>
      </div>
          {!! Form::close() !!}
    </div>

   </div>
  <!-- /.card -->

  </section>
  <!-- /.content -->


  @endsection
