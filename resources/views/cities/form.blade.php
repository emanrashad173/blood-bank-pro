<div class="form-group">
  <label for="name">Name</label>
  {!! Form::text('name' ,null, [
  'class' =>'form-control'
  ])!!}
</div>
<div class="form-group">
  <label for="id">Governorate</label>
  {!! Form::select('governorate_id',App\Models\Governorate::pluck('name','id'));
!!}
</div>
<div class="form-group">
  <button class="btn btn-primary" type="submit">Add</button>
</div>
