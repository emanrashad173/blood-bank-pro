<div class="form-group">
  <label for="title">Title</label>
  {!! Form::text('title' ,null, [
  'class' =>'form-control'
  ])!!}
</div>
<div class="form-group">
  <label for="content">content</label>
  {!! Form::text('content' ,null, [
  'class' =>'form-control'
  ])!!}
</div>
<div class="form-group">
  <label for="image">Image</label>
  <br>
  {!! Form::file('image')!!}
</div>
<div class="form-group">
  <label for="id">Category</label>
  {!! Form::select('category_id',App\Models\Category::pluck('name','id'));
!!}
</div>
<div class="form-group">
  <button class="btn btn-primary" type="submit">Add</button>
</div>
