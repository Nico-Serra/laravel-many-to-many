<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Project;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();

        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = Technology::all();

        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $val_data = $request->validated();

        //dd($val_data);

        $slug = Str::slug($request->name, '-');

        $val_data['slug'] = $slug;

        Technology::create($val_data);

        return to_route('admin.technologies.index')->with('message', 'Technology created with success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        $projects = $technology->projects()->get();

        //dd($projects);

        return view('admin.technologies.show', compact('projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $val_data = $request->validated();

        //dd($val_data);

        $slug = Str::slug($request->name, '-');

        $val_data['slug'] = $slug;

        $technology->update($val_data);

        return to_route('admin.technologies.index')->with('message', 'Technology updated with success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return back()->with('message', $technology->name . ' deleted with success');
    }
}
