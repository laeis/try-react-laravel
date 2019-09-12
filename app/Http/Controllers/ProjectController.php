<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        $projects = Project::active()
            ->orderBy('created_at', 'desc')
            ->withCount(['tasks' => function ($query) {
                $query->active();
            }])
            ->get();

        return $projects->toJson();
    }

    public function store(Request $request)
    { 
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $project = Project::create($validatedData);

        return response()->json('Project created!');
    }

    public function show(Project $project)
    {
        $project = $project->with(['tasks' => function($q){
            $q->active();
        }]);

        return $project->toJson();
    }

    /**
     * markAsCompleated
     *
     * @param  int $project id
     *
     * @return JSON
     */
    public function markAsCompleated(Project $project)
    {
        $status = 200;
        $message = 'Project updated!';
        try {
            $project->is_compleated = true;
            $project->update();
        } catch (Exception $e) {
            $status  = 500;
            $message = $e->getMessage();
        }
        
        return response()->json($message, $status);
    }
}
