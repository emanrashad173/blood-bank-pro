@extends('layouts.admin-app')
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Users</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
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
        <h3 class="card-title">List of Users</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        <a href="{{url(route('user.create'))}}" class="btn btn-primary"><i class="fa fa-user-plus"></i> New User</a>
      

        @include('flash::message')


        @if(count($users))
         <div class="table-responsive">
           <table class="table table-bordered">
             <thead>
               <tr>
                 <th>Num</th>
                 <th>Name</th>
                 <th>Email</th>
                 <th>Role</th>
                 <th class="text-center">Edit</th>
                 <th class="text-center">Delete</th>
               </tr>
             </thead>
             <tbody>
               @foreach($users as $user)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                  @foreach($user->roles as $role)
                   <span class="badge badge-warning">{{$role->display_name}}</span>
                  @endforeach
                </td>
                  <td class="text-center">
                    <a href="{{url(route('user.edit',$user->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                  </td>
                  <td class="text-center">
                    {!! Form::open([
                      'action' =>['UserController@destroy' ,$user->id],
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
