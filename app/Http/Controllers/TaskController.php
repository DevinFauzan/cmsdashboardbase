<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all(); // Retrieve all tasks from the Task model
        return view('tasks.index', compact('tasks')); // Pass tasks to the "index" view
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    return view('tasks.create'); // Display the "Create Task" form view
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'taskName' => 'required|max:255',
    ]);

    $task = new Task();
    $task->taskName = $request->input('taskName');
    $task->save();

    return redirect()->route('tasks.index'); // Redirect to the task listing page
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    $task = Task::find($id); // Find the task by ID
    return view('tasks.show', compact('task')); // Display the task details
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $task = Task::find($id); // Find the task by ID
    return view('tasks.edit', compact('task')); // Display the "Edit Task" form view
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
    $validatedData = $request->validate([
        'taskName' => 'required|max:255',
    ]);

    $task = Task::find($id);
    $task->taskName = $request->input('taskName');
    $task->save();

    return redirect()->route('tasks.index'); // Redirect to the task listing page
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $task = Task::find($id);
    $task->delete();

    return redirect()->route('tasks.index'); // Redirect to the task listing page
}

}
