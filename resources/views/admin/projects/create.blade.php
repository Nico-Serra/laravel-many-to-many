@extends('layouts.admin')

@section('content')
    <div class="container py-5">
        @include('partials.validations-errors')

        <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="NamehelpId" placeholder="Laravel-auth project" value="{{ old('name') }}" />
                <small id="NamhelpId" class="form-text text-muted">Insert your project name</small>
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">cover_image</label>
                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image"
                    id="cover_image" aria-describedby="cover_imagehelpId" value="{{ old('cover_image') }}" />
                <small id="cover_imagehelpId" class="form-text text-muted">Insert your project cover image</small>
            </div>

            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select form-select-sm" name="type_id" id="type_id">
                    <option selected disabled>Select the type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Technologies --}}


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

            <div class="mb-3">
                <label for="link" class="form-label">link</label>
                <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" id="link"
                    aria-describedby="linkhelpId" placeholder="//http:" value="{{ old('link') }}" />
                <small id="linkhelpId" class="form-text text-muted">Insert your project link</small>
            </div>

            <div class="mb-3">
                <label for="link_code" class="form-label">link_code</label>
                <input type="text" class="form-control @error('link_code') is-invalid @enderror" name="link_code"
                    id="link_code" aria-describedby="link_codehelpId" placeholder="//http:"
                    value="{{ old('link_code') }}" />
                <small id="link_codehelpId" class="form-text text-muted">Insert your project link_code</small>
            </div>

            <div class="mb-3">
                <label for="project_date" class="form-label">date</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" name="project_date"
                    id="project_date" aria-describedby="datehelpId" value="{{ old('project_date') }}" />
                <small id="datehelpId" class="form-text text-muted">Insert your project date</small>
            </div>

            <button type="submit" class="btn btn-warning">
                Add
            </button>

        </form>



    </div>
@endsection
