@extends('layouts.admin-edit')

@section('page_header')
Add Project
@stop

@section('side_link')
<a href="">Add Project</a>
@stop
@section('content')

<div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6 col-sm-offset-3 align-items-sm-center">
    @include('includes.form_errors')
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Add Project</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="post" action="{{route('projects.update',$project->id)}}">
        @method('PUT')
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Project Name</label>
            <input type="text" name="project_name" value="{{$project->project_name}}" class="form-control @error('project_name') is-invalid @enderror" id="exampleInputEmail1" placeholder="Project Name">
            @error('project_name')
            <span class="invalid-feedback row" role="alert" style="display: inherit !important;">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Start Date</label>
            <input type="date" name="start_date" value="{{$project->start_date->format('Y-m-d')}}" class="form-control @error('start_date') is-invalid @enderror" id="exampleInputPassword1">
            @error('start_date')
            <span class="invalid-feedback row" role="alert" style="display: inherit !important;">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">End Date</label>
            <input type="date" name="end_date" value="{{$project->end_date->format('Y-m-d')}}" class="form-control @error('end_date') is-invalid @enderror" id="exampleInputPassword1">
            @error('end_date')
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