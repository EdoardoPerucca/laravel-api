<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('type', 'technologies')->orderBy('projects.created_at', 'desc')->paginate(10);

        $technologies = Technology::all();

        return response()->json([
            'success' => true,
            'result' => $projects,
            'allTechnology' => $technologies,
        ]);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Il progetto non esiste',
            ]);
        }
    }
}
