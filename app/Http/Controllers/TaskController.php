<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    //
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'project_id' => 'required|exists:projects,id'
        ]);
            
        $task = Task::create($validatedData);

        return $task->toJson();
    }

    public function markAsCompleated(Task $task)
    {
        $status = 200;
        $message = 'Task updated!';
        try {
            $task->is_compleated = true;
            $task->update();
        } catch (Exception $e) {
            $status  = 500;
            $message = $e->getMessage();
        }
        
        return response()->json($message, $status);
    }
}
