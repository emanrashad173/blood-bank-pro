@extends('layouts.admin-app')
@inject('client','App\Models\Client')
@inject('donation_request','App\Models\DonationRequest')
@inject('contact','App\Models\Contact')
@inject('post','App\Models\Post')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/admin/home')}}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-body">
      <h3 class="text-center">  Welcome to Dashboard</h3>
      </div>
      <!-- /.card-body -->

    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fas  fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Client</span>
              <span class="info-box-number">{{$client->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fas  fa-heart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Donation Request</span>
              <span class="info-box-number">{{$donation_request->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fas  fa-clone"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Post</span>
              <span class="info-box-number">{{$post->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-olive"><i class="fas  fa-phone"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Contact</span>
              <span class="info-box-number">{{$contact->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>

    <!-- /.card -->

  </section>
  <!-- /.content -->


@endsection
