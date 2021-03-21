<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Project::paginate(5);

        return view('admin.projects.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name'        => 'required|max:150',
            'start_date'          => 'required|before:end_date',
            'end_date'            => 'required|after:start_date',
        ]);
        $project = new Project;
        $project->project_name=$request->project_name;
        $project->start_date=$request->start_date;
        $project->end_date=$request->end_date;
        $project->user_id=auth()->user()->id;
        if (! $project->save())
            return back()->with('Error','error occured please try again');
        return back()->with('success','data saved successfuly');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $tasks = Project::find($id)->tasks();
        $data =$tasks->paginate(5);
        $project_id=$id;
        $tasks_count= Task::where('project_id',$id)->count() ?:1;
        $done_tasks = Task::where('project_id',$id)->where('status','2')->count();
        $progress = floor(($done_tasks/$tasks_count)*100);
        return view('admin.tasks.index',compact('data','project_id','progress'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project=Project::findOrFail($id);
  
        return view('admin.projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'project_name'        => 'required|max:150',
            'start_date'          => 'required|before:end_date',
            'end_date'            => 'required|after:start_date',
        ]);
        $project = Project::findOrFail($id);
        $project->project_name=$request->project_name;
        $project->start_date=$request->start_date;
        $project->end_date=$request->end_date;
        if (! $project->save())
            return back()->with('Error','error occured please try again');
        return back()->with('success','data updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if($project->tasks()->count())
            return back()->with('Error','project related with data');
        if(! $project->delete())
            return back()->with('Error','error occured please try again');
        return back()->with('success','data deleted successfuly');
    }
}
