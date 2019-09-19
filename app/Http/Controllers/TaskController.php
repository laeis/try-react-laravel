<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Database\QueryException;

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

        return response()->json($task, 201);
    }

    public function markAsCompleated(Task $task)
    {
        $status = 200;
        $response['message'] = 'Task updated!';
        try {
            $task->is_compleated = true;
            $task->update();
        } catch (QueryException $e) {
            $status  = 500;
            $response['message'] = 'Error updating task, wrong query or database structure';
        } catch (\Exception $e) {
            $status  = 500;
            $response['message'] = 'Something went wrong. Server error';
        }
        
        return response()->json($response, $status);
    }
}
