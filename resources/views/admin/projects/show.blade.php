@extends('layouts.admin')

@section('content')
    <div class="container py-5 text-center text-center">
        <div class="row">
            <div class="col">
                @if (Str::startsWith($project->cover_image, 'https://'))
                    <img src="{{ $project->cover_image }}" alt="" class="img-fluid ">
                @else
                    <img src="{{ asset('storage/' . $project->cover_image) }}" alt="" class="img-fluid ">
                @endif

            </div>
            <div class="col">
                <div class="text-center">

                    <div class="metadata">
                        <h2 class="mb-3">{{ $project->name }}</h2>
                        <a href="{{ $project->link }}" class="btn btn-dark btn-sm mb-3">🌍Site</a>
                        <a href="{{ $project->link_code }}" class="btn btn-dark btn-sm mb-3">Code</a>
                        <div class="mb-3">
                            Project Date : <strong>{{ $project->project_date }}</strong>
                        </div>
                        <div class="mb-3">
                            <strong>Type:</strong> {{ $project->type ? $project->type->name : 'Untype' }}
                        </div>
                        @forelse ($project->technologies()->get() as $tech)
                            {{-- @dd($project->technologies()->get()) --}}
                            <div class="badge text-bg-dark">
                                {{ $tech->name }}
                            </div>
                        @empty
                            <div class="badge text-bg-dark">
                                Nothing Technologies
                            </div>
                        @endforelse
                    </div>

                    <div class="py-5">
                        {{-- <h2>Actions</h2> --}}
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-warning ">⬅ Go Back</a>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning ">🖊Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
