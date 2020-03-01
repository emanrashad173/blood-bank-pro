@extends('layouts.admin-app')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>ContactUs</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active">ContactUs</li>
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
        <h3 class="card-title">List of ContactUs</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        {!! Form::open(['method'=>'GET','action'=>'ContactUsController@index','class'=>'navbar-form navbar-left','role'=>'search'])  !!}

        <div class="row">

          <div class="col-sm-3">
            {!! Form::text('search_by_subject_or_message',request('search_by_subject_or_message'),[
            'placeholder' => 'search_by_subject_or_message',
            'class' => 'form-control'
            ]) !!}
          </div>

          <div class="col-sm-3">
            <button type="submit" class="btn btn-primary "><i class="fa fa-search"></i> Search</button>
          </div>

        </div>
      {!! Form::close()!!}
      </br>
        @include('flash::message')

        @if(count($records))
         <div class="table-responsive">
           <table class="table table-bordered">
             <thead>
               <tr>
                 <th>Num</th>
                 <th>Name</th>
                 <th>Phone</th>
                 <th>Email</th>
                 <th>Subject</th>
                 <th>Message</th>
                 <th>Recieved_at</th>
                 <th class="text-center">Delete</th>
               </tr>
             </thead>
             <tbody>
               @foreach($records as $record)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$record->name}}</td>
                  <td>{{$record->phone}}</td>
                  <td>{{$record->email}}</td>
                  <td>{{$record->subject}}</td>
                  <td>{{$record->message}}</td>
                  <td>{{$record->created_at}}</td>



                  <td class="text-center">
                    {!! Form::open([
                      'action' =>['ContactUsController@destroy' ,$record->id],
                      'method' => 'delete'
                      ])!!}
                      <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                      {!! Form::close()!!}
                  </td>

                </tr>
               @endforeach
             </tbody>

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
