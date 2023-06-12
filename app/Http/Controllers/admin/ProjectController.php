<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        //$user_id = Auth::id();

        //$projects = Project::where('user_id', $user_id)->get();
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

        if ($request->hasFile('cover_image')) {

            $path = Storage::put('project_images', $request->cover_image);

            $formData['cover_image'] = $path;
        }
        //dd($formData);

        $newProject = new Project();

        $newProject->fill($formData);

        $newProject->user_id = Auth::id();

        $newProject->slug = Str::slug($newProject->title, '-');

        $newProject->save();

        if (array_key_exists('technologies', $formData)) {

            $newProject->technologies()->attach($formData['technologies']);
        }



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
        if ($project->user_id == Auth::id()) {

            return view('admin/projects/show', compact('project'));
        } else {

            return redirect()->route('admin.projects.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        if ($project->user_id != Auth::id()) {
            return redirect()->route('admin.projects.index');
        }

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

        if ($request->hasFile('cover_image')) {

            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }

            $path = Storage::put('project_images', $request->cover_image);

            $formData['cover_image'] = $path;
        }

        //dd($formData);
        $project->slug = Str::slug($formData['title'], '-');

        $project->update($formData);

        if (array_key_exists('technologies', $formData)) {

            $project->technologies()->sync($formData['technologies']);
        } else {

            $project->technologies()->detach();
        }


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
        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }

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
            'technologies' => 'exists:technologies,id',
            'cover_image' => 'nullable|image|max:4000',
        ], [
            'title.required' => 'Il titolo è richiesto',
            'title.max' => 'Il titolo deve avere massimo :max caratteri',
            'title.max' => 'Il titolo deve avere minimo :min caratteri',
            'repo.required' => 'Il link è richiesto',
            'repo.max' => 'Il link deve avere massimo :max caratteri',
            'content.required' => 'Il progetto deve avere la descrizione',
            'type_id.exists' => 'La tipologia deve essere presente nel sito',
            'technologies.exists' => 'La tecnologia deve esistere nel nostro sito',
            'cover_image.image' => 'Il file deve essere formato immagine',
            'cover_image.max' => 'Il file non deve eccedere i 2 MB',

        ])->validate();

        return $validator;
    }
}
