<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $formData = $request->all();

        $this->validation($formData);

        $newProject = new Project();

        $newProject->fill($formData);

        $newProject->slug = Str::slug($newProject->title, '-');

        $newProject->technologies()->attach($formData['technologies']);

        $newProject->save();

        return redirect()->route('admin.projects.show', $newProject);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin/projects/show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $formData = $request->all();

        $this->validation($formData);

        $project->slug = str::slug($formData['title'], '-');

        $project->update($formData);

        $project->technologies->sync($formData['tecnologies']);

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }

    private function validation($formData)
    {
        $validator = Validator::make($formData, [
            'title' => 'required|max:255|min:3',
            'repo' => 'required|max:255',
            'content' => 'required',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id'
        ], [
            'title.required' => 'Il titolo è richiesto',
            'title.max' => 'Il titolo deve avere massimo :max caratteri',
            'title.max' => 'Il titolo deve avere minimo :min caratteri',
            'repo.required' => 'Il link è richiesto',
            'repo.max' => 'Il link deve avere massimo :max caratteri',
            'content.required' => 'Il progetto deve avere la descrizione',
            'type_id.exists' => 'La tipologia deve essere presente nel sito',
            'technologies.exists' => 'La tecnologia deve esistere nel nostro sito',
        ])->validate();

        return $validator;
    }
}
