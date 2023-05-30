<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('type', 'technologies')->orderBy('projects.created_at', 'desc')->paginate(6);

        return response()->json([
            'success' => true,
            'result' => $projects
        ]);
    }
}