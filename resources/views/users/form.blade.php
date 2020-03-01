@inject('role' ,'App\Models\Role')
<?php
$roles =$role ->pluck('display_name','id')->toArray();
 ?>
<div class="form-group">
  <label for="name">Name</label>
  {!! Form::text('name' ,null, [
  'class' =>'form-control'
  ])!!}
</div>
<div class="form-group">
  <label for="email">Email</label>
  {!! Form::text('email' ,null, [
  'class' =>'form-control'
  ])!!}
</div>
<div class="form-group">
  <label for="password">Password</label>
  {!! Form::password('password', [
  'class' =>'form-control'
  ])!!}
</div>
<div class="form-group">
  <label for="password_confirmation">Password_Confirmation</label>
  {!! Form::password('password_confirmation' , [
  'class' =>'form-control'
  ])!!}
</div>
<div class="form-group">
  <label for="role_list">Role</label>
  {!! Form::select('roles_list[]' ,$roles,null, [
  'class' =>'form-control',
  'multiple' => 'multiple'
  ])!!}
  <!-- <select class="control-form-select-multiple" name="roles_list[]" multiple="multiple"> -->
    <!-- @foreach($role as $roles) -->
      <!-- <option value="$roles->name">{{$roles->name}}</option> -->
    <!-- @endforeach -->
  <!-- </select> -->

</div>


<div class="form-group">
</div>
<button class="btn btn-primary" type="submit">Add</button>
