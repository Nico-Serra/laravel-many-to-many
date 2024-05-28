<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Str;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();

        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.types.index', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        //dd($request->all());

        $val_data = $request->validated();

        //dd($val_data);

        $slug = Str::slug($request->name, '-');

        $val_data['slug'] = $slug;

        Type::create($val_data);

        return to_route('admin.types.index')->with('message', 'Type created with success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //$projects = Project::all();

        $projects = Project::where('type_id', $type->id)->get();

        //dd($projects);

        return view('admin.types.show', compact('projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {

        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $val_data = $request->validated();

        //dd($val_data);

        $slug = Str::slug($request->name, '-');

        $val_data['slug'] = $slug;

        $type->update($val_data);

        return to_route('admin.types.index')->with('message', 'Type updated with success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return back()->with('message', $type->name . ' deleted with success');
    }
}
