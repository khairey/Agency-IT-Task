<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function __construct()
    {
        // Middleware only applied to these methods
        $this->middleware('isAdmin', [
            'only' => [
                'store',
                'update',
                'show',
            ]
        ]);
    }

    public function getAllTasks()
    {
        $tasks = Task::where('employee_id', auth()->user()->id)->get();
        return response()->json([
            $tasks
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json([
            Task::create(array_merge($request->all(), ['user_id' =>  $request->user()->id]))
        ]);
    }

    public function update(Request $request, Task $task)
    {
        if (!$task->complete) {
            $task->update($request->all());
            return response()->json([
                $task
            ]);
        } else {
            return response()->json(['error' => 'task completed'], 200);
        }
    }
    public function show(Task $task)
    {
        return response()->json([
            $task
        ]);
    }

    public function submitTask($id)
    {

        $task = Task::find($id);
        if (!$task->complete) {
            $task->complete = true;
            $task->save();
            return response()->json([
                $task
            ]);
        }else{
            return response()->json(['error' => 'task completed'], 200);
        }
    }
}
