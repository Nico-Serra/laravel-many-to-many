@extends('layouts.admin')

@section('content')
    <div class="container py-5">
        @include('partials.validations-errors')

        <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">
            @csrf

            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="NamehelpId" placeholder="Laravel-auth project"
                    value="{{ old('name', $project->name) }}" />
                <small id="NamhelpId" class="form-text text-muted">Insert your project name</small>
            </div>

            <div class="mb-3 d-flex ">
                @if (Str::startsWith($project->cover_image, 'https://'))
                    <img src="{{ $project->cover_image }}" alt="" width="150">
                @else
                    <img src="{{ asset('storage/' . $project->cover_image) }}" alt="" width="150">
                @endif
                <div class="px-4 ">
                    <label for="cover_image" class="form-label">cover_image</label>
                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image"
                        id="cover_image" aria-describedby="cover_imagehelpId"
                        value="{{ old('cover_image', $project->cover_image) }}" />
                    <small id="cover_imagehelpId" class="form-text text-muted">Insert your project cover image</small>
                </div>
            </div>

            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select form-select-sm" name="type_id" id="type_id">
                    <option selected disabled>Select the type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}"
                            {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            @if ($errors->any())
                <div>
                    <span>Insert the technolgies with you used in
                        our project:</span>
                    <div class="d-flex m-3 justify-content-between flex-wrap">
                        @foreach ($technologies as $tech)
                            <div class="form-check">
                                <input name="technologies[]" class="form-check-input" type="checkbox"
                                    value="{{ $tech->id }}" id="technolgies-{{ $tech->id }}"
                                    {{ in_array($tech->id, old('technologies', [])) ? 'checked' : '' }} />
                                <label class="form-check-label"
                                    for="technolgies-{{ $tech->id }}">{{ $tech->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    @error('technologies')
                        <div class="text-danger py-2">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            @else
                <div>
                    <span>Insert the technolgies with you used in
                        our project:</span>
                    <div class="d-flex m-3 justify-content-between flex-wrap">
                        @foreach ($technologies as $tech)
                            <div class="form-check">
                                <input name="technologies[]" class="form-check-input" type="checkbox"
                                    value="{{ $tech->id }}" id="technolgies-{{ $tech->id }}"
                                    {{ $project->technologies()->get()->contains($tech->id)? 'checked': 'no' }} />
                                <label class="form-check-label"
                                    for="technolgies-{{ $tech->id }}">{{ $tech->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    @error('technologies')
                        <div class="text-danger py-2">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            @endif

            <div class="mb-3">
                <label for="link" class="form-label">link site</label>
                <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" id="link"
                    aria-describedby="linkhelpId" placeholder="//http:" value="{{ old('link', $project->link) }}" />
                <small id="linkhelpId" class="form-text text-muted">Insert your project link</small>
            </div>

            <div class="mb-3">
                <label for="link_code" class="form-label">link_code site</label>
                <input type="text" class="form-control @error('link_code') is-invalid @enderror" name="link_code"
                    id="link_code" aria-describedby="link_codehelpId" placeholder="//http:"
                    value="{{ old('link_code', $project->link_code) }}" />
                <small id="link_codehelpId" class="form-text text-muted">Insert your project link code</small>
            </div>

            <div class="mb-3">
                <label for="project_date" class="form-label">project_date</label>
                <input type="date" class="form-control @error('project_date') is-invalid @enderror" name="project_date"
                    id="project_date" aria-describedby="project_datehelpId"
                    value="{{ old('project_date', $project->project_date) }}" />
                <small id="project_datehelpId" class="form-text text-muted">Insert your project date</small>
            </div>

            <button type="submit" class="btn btn-warning">
                💾 save
            </button>

        </form>



    </div>
@endsection
