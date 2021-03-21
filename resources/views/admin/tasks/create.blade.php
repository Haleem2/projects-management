@extends('layouts.admin-edit')

@section('page_header')
Add Task
@stop

@section('side_link')
<a href="">Add Task</a>
@stop
@section('content')

<div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6 col-sm-offset-3 align-items-sm-center">
    @include('includes.form_errors')
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Add Task</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="post" action="{{url('projects/'.$project_id.'/tasks')}}">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Task Name</label>
            <input type="text" name="task_name" value="{{old('task_name')}}" class="form-control @error('task_name') is-invalid @enderror" placeholder="Project Name">
            @error('task_name')
            <span class="invalid-feedback row" role="alert" style="display: inherit !important;">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>

  </div>
</div>

@stop