<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id)
    {
        return view('admin.tasks.create', compact('project_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $project_id)
    {
        $request->validate([
            'task_name'        => 'required|max:150',
        ]);
        $task = new Task;
        $task->task_name = $request->task_name;
        $task->project_id = $project_id;
        if (!$task->save())
            return back()->with('Error', 'error occured please try again');
        return back()->with('success', 'data saved successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id, $id)
    {
        $task = Task::findOrFail($id);

        return view('admin.tasks.edit', compact('task','project_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project_id, $id)
    {
        $request->validate([
            'task_name'        => 'required|max:150',
        ]);
        $task = Task::findOrFail($id);
        $task->task_name = $request->task_name;
        if (!$task->save())
            return back()->with('Error', 'error occured please try again');
        return back()->with('success', 'data updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id, $id)
    {
        $task = Task::findOrFail($id);

        if (!$task->delete())
            return back()->with('Error', 'error occured please try again');
        return back()->with('success', 'data deleted successfuly');
    }
    public function updateStatus($id)
    {
        $task = Task::findOrFail($id);
        switch ($task->status) {
            case '0':
                $task->status = '1';
                break;

            default:
                $task->status = '2';
                break;
        }
        if (!$task->save())
            return back()->with('Error', 'error occured please try again');
        return back()->with('success', 'status updated successfuly');
    }
}
