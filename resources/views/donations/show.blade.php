@extends('layouts.admin-app')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Donation Request</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active">Donation Request</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Donation Request</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        @if($record)
         <div class="table-responsive">
           <table class="table table-bordered">
                <tr>
                  <td >Patient_Name</td>
                  <td class="col sm-3">{{$record->patient_name}}</td>
                </tr>
                <tr>
                  <td>Patient_Age</td>
                  <td>{{$record->patient_age}}</td>
                </tr>
                <tr>
                  <td>Blood_Type</td>
                  <td>{{$record->bloodType->name}}</td>
                </tr>
                <tr>
                  <td>Bags_Num</td>
                  <td>{{$record->bags_num}}</td>
                </tr>
                <tr>
                  <td>Hospital_Name</td>
                  <td>{{$record->hospital_name}}</td>
                </tr>
                <tr>
                  <td>Hospital_Address</td>
                  <td>{{$record->hospital_address}}</td>
                </tr>
                <tr>
                  <td>Latitude</td>
                  <td>{{$record->latitude}}</td>
                </tr>
                <tr>
                  <td>Longtitude</td>
                  <td>{{$record->longtitude}}</td>
                </tr>
                <tr>
                  <td>City</td>
                  <td>{{$record->city->name}}</td>
                </tr>
                <tr>
                  <td>Phone</td>
                  <td>{{$record->phone}}</td>
                </tr>
                <tr>
                  <td>Notes</td>
                  <td>{{$record->notes}}</td>
                </tr>
                <tr>
                  <td>Client</td>
                  <td>{{$record->client->name}}</td>
                </tr>
                <tr>
                  <td>Created_at</td>
                  <td>{{$record->created_at}}</td>
                </tr>
           </table>
         </div>
          @else
          <div class="alert alert.danger" role="alert">
             No Data
          </div>
        @endif
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->


@endsection
