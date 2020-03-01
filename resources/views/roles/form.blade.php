@inject('perm','App\Models\Permission')
<div class="form-group">
  <label for="name">Name</label>
  {!! Form::text('name' ,null, [
  'class' =>'form-control'
  ])!!}
</div>
<div class="form-group">
  <label for="name">Display_Name</label>
  {!! Form::text('display_name' ,null, [
  'class' =>'form-control'
  ])!!}
</div>
<div class="form-group">
  <label for="name">Description</label>
  {!! Form::textarea('description' ,null, [
  'class' =>'form-control'
  ])!!}
</div>
<div class="form-group">
  <label for="name">Permissions</label><br>
  <input id="select-all" type="checkbox"><label for='select-all'> اختيار الكل</label>
  <div class="row">
    @foreach($perm->all() as $permission)
     <div class="col-sm-3">
       <div class="checkbox">
         <label>
           <input type="checkbox"
           @if($model->hasPermission($permission->name))
             checked
           @endif
             value="{{$permission->id}}" name="permissions_list[]">{{$permission->display_name}}
         </label>
       </div>
     </div>
    @endforeach
<div class="form-group">
</div>
<button class="btn btn-primary" type="submit">Add</button>
@push('scripts')
<script>
$("#select-all").click(function(){
  $("input[type=checkbox]").prop('checked',$(this).prop('checked'));
});
</script>
@endpush
