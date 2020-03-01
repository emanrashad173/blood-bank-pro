@extends('layouts.admin-app')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Post</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active">Post</li>
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
        <h3 class="card-title">List of Posts</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">

        {!! Form::open(['method'=>'GET','action'=>'PostController@index','class'=>'navbar-form navbar-left','role'=>'search'])  !!}

        <div class="row">

          <div class="col-sm-3">
            {!! Form::text('search_by_title_or_content',request('search_by_title_or_content'),[
            'placeholder' => 'Search by Title or Content',
            'class' => 'form-control'
            ]) !!}
          </div>
          <div class="col-sm-3">
            {!! Form::select('category_id',App\Models\Category::pluck('name','id')->toArray(),request('category_id'),[
              'class' => 'form-control',
              'placeholder' => 'اختر النوع'
              ])!!}
          </div>

          <div class="col-sm-3">
            <button type="submit" class="btn btn-primary "><i class="fa fa-search"></i> Search</button>
          </div>

        </div>
      {!! Form::close()!!}
      </br>
      <a href="{{url(route('post.create'))}}" class="btn btn-primary "><i class="fa fa-plus"></i> New Post</a>

        @include('flash::message')

        @if(count($records))
         <div class="table-responsive">
           <table class="table table-bordered">
             <thead>
               <tr>
                 <th>Num</th>
                 <th>Title</th>
                 <th>Content</th>
                 <th>Image</th>
                 <th>Category</th>
                 <th>Created_at</th>
                 <th>Updated_at</th>
                 <th class="text-center">Edit</th>
                 <th class="text-center">Delete</th>
               </tr>
             </thead>
             <tbody>
               @foreach($records as $record)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$record->title}}</td>
                  <td>{{$record->content}}</td>
                  <td><img src="{{asset($record->image)}}" height="50px" width="50px"></td>
                  <th>{{$record->category->name}}</th>
                  <td>{{$record->created_at}}</td>
                  <td>{{$record->updated_at}}</td>
                  <td class="text-center">
                    <a href="{{url(route('post.edit',$record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                  </td>
                  <td class="text-center">
                    {!! Form::open([
                      'action' =>['PostController@destroy' ,$record->id],
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
