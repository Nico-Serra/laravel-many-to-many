@extends('layouts.admin')

@section('content')
    <div class="container py-5">
        @include('partials.validations-errors')

        <form action="{{ route('admin.technologies.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="NamehelpId" placeholder="Npm" value="{{ old('name') }}" />
                <small id="NamhelpId" class="form-text text-muted">Insert your technology project</small>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-warning">
                    Add
                </button>
            </div>

        </form>



    </div>
@endsection
