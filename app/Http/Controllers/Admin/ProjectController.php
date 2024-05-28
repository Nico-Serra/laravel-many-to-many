<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(8);

        //dd($projects);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $val_data = $request->validated();


        //dd($val_data);

        $slug = Str::slug($request->name, '-');

        //dd($slug);

        $val_data['slug'] = $slug;

        if ($request->has('cover_image')) {
            $image_path = Storage::put('uploads', $val_data['cover_image']);

            $val_data['cover_image'] = $image_path;
        }


        //dd($val_data['technologies']);

        //$val_data['type_id'] = $request['type_id'];

        //dd($val_data);

        $project = Project::create($val_data);

        if ($project->has('technologies')) {

            $project->technologies()->attach($val_data['technologies']);
            //dd($project->technologies);
        }

        // dd($project);

        return to_route('admin.projects.index')->with('message', 'Project created with success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //dd($project);

        return View('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();

        //dd($val_data);

        $slug = Str::slug($request->name, '-');

        //dd($slug);

        $val_data['slug'] = $slug;

        //dd($val_data['cover_image']);

        //dd($request->has('cover_image'));

        if ($request->has('cover_image')) {

            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }

            $image_path = Storage::put('uploads', $val_data['cover_image']);

            $val_data['cover_image'] = $image_path;

            //dd($image_path, $val_data);
        }

        //$val_data['type_id'] = $request['type_id'];

        //dd($val_data);
        if ($request->has('technologies')) {
            // $project->technologies()->detach($project->technologies()->get());



            $project->technologies()->sync($val_data['technologies']);
            //dd($project->technologies);
            //dd($project->technologies()->get());
        } else {
            $project->technologies()->sync([]);
        }
        //dd($project->technologies()->get());

        $project->update($val_data);

        return to_route('admin.projects.index')->with('message', $project->name . ' updated with success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        //dd($project);

        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }

        if ($project->has('technologies')) {
            $project->technologies()->detach($project->technologies()->get());
        }

        $project->delete();

        return to_route('admin.projects.index')->with('message', $project->name . ' deleted with success');
    }
}
