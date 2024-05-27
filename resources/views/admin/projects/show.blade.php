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

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modalId-{{ $project->id }}">
                            🗑 Delete
                        </button>

                        <!-- Modal Body -->
                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                        <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1" data-bs-backdrop="static"
                            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{ $project->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitleId-{{ $project->id }}">
                                            You want to delete this project
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">{{ $project->name }}</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <form action="{{ route('admin.projects.destroy', $project) }}" method="post">
                                            @csrf

                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">
                                                Delete
                                            </button>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
