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
  <a class="btn btn-primary" href="{{route('projects.create')}}">Create Project</a>
  @if(count($data)>0)
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Project Name</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      @foreach($data as $i=>$item)
      <tr>
        <td>{{++$i}}</td>
        <td>{{$item->project_name}}</td>
        <td>{{$item->start_date->format('Y-m-d')}}</td>
        <td>{{$item->end_date->format('Y-m-d')}}</td>
        <td>
          <a href="{{route('projects.show',$item->id)}}" class="btn btn-sm btn-outline-success">tasks</a>
          <a href="{{route('projects.edit',$item->id)}}" class="btn btn-sm btn-icon btn-outline-warning"><i class="fas fa-edit"></i></a>
          <form action="{{url('projects/'.$item->id)}}" method="post" style="display: inline">
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