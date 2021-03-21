@extends('layouts.admin-edit')

@section('page_header')
All Projects
@stop

@section('side_link')
<a href="">All Projects</a>
@stop
@section('content')

@include('includes.form_errors')

<div class="row">
  <a class="btn btn-primary" href="{{url('projects/'.$project_id.'/tasks/create')}}">Create Task</a>
  <div class="col-12">
    <h5>Project Progress</h5>
    <div class="progress" >
      <div class="progress-bar"  role="progressbar" style="width: {{$progress}}%;" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">{{$progress}}%</div>
    </div>
  </div>
  @if(count($data)>0)
  <table class="table table-bordered table-striped" style="margin-top: 20px!important;">
    <thead>
      <tr>
        <th>#</th>
        <th>Task Name</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      @foreach($data as $i=>$item)
      <tr>
        <td>{{++$i}}</td>
        <td>{{$item->task_name}}</td>
        <td>
          @if($item->status == '0')
          <span class="badge rounded-pill bg-info text-light">TO DO</span>
          @elseif($item->status =='1')
          <span class="badge rounded-pill bg-warning text-light">ON PROGRESS</span>
          @else
          <span class="badge rounded-pill bg-success text-light">FINISHED</span>
          @endif
        </td>
        <td>

          <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            change status
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          @if($item->status == '0')
            <a class="dropdown-item" href="{{url('tasks/'.$item->id)}}">on progress</a>
            @else
            <a class="dropdown-item" href="{{url('tasks/'.$item->id)}}">finished</a>
          @endif
          </div>

          <a href="{{url('projects/'.$project_id.'/tasks/'.$item->id.'/edit')}}" class="btn btn-sm btn-icon btn-outline-warning"><i class="fas fa-edit"></i></a>
          <form action="{{url('projects/'.$project_id.'/tasks/'.$item->id)}}" method="post" style="display: inline">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm btn-clean btn-icon"><i class="fas fa-trash-alt"></i></button>
          </form>
        </td>
      </tr>
      @endforeach


    </tbody>
  </table>
  @else
  <h3 class="alert alert-warning col-12" style="margin-top: 10px;">No Data Available</h3>
  @endif
</div>

<div class="row">
  <div class="mx-auto ">
    {{$data->render()}}

  </div>
</div>
@stop