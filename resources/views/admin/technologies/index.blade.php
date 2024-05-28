@extends('layouts.admin')


@section('content')
    <section class="bg-light py-3">
        <div class="container d-flex align-items-center justify-content-between py-3">
            <h1>Tecnologies</h1>

        </div>



        <div class="container text-center ">
            @include('partials.message')

            <div class="row align-items-center">
                <div class="col-6">
                    @include('partials.validations-errors')

                    <h4>Add new Technology</h4>

                    <form action="{{ route('admin.technologies.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <div class="d-flex">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" aria-describedby="NamehelpId" placeholder="Npm"
                                    value="{{ old('name') }}" />
                                <div class="text-center">
                                    <button type="submit" class="btn btn-warning">
                                        Add
                                    </button>
                                </div>
                            </div>

                            <small id="NamhelpId" class="form-text text-muted">Insert your technology project</small>

                        </div>


                    </form>
                </div>



                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table table-secondary ">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Actions</th>


                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($technologies as $tech)
                                    <tr class="">
                                        <td>{{ $tech->name }}</td>
                                        <td>{{ $tech->slug }}</td>
                                        <td>
                                            <a href="{{ route('admin.technologies.show', $tech) }}"
                                                class="btn btn-dark btn-sm">👁‍🗨View
                                                All Projects {{ $tech->name }}</a>
                                            <a href="{{ route('admin.technologies.edit', $tech) }}"
                                                class="btn btn-dark btn-sm">🖊</a>
                                            <!-- Modal trigger button -->
                                            <button tech="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalId-{{ $tech->id }}">
                                                🗑
                                            </button>

                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                            <div class="modal fade" id="modalId-{{ $tech->id }}" tabindex="-1"
                                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                aria-labelledby="modalTitleId-{{ $tech->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalTitleId-{{ $tech->id }}">
                                                                You want to delete this tech
                                                            </h5>
                                                            <button tech="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">{{ $tech->name }}</div>
                                                        <div class="modal-footer">
                                                            <button tech="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <form action="{{ route('admin.technologies.destroy', $tech) }}"
                                                                method="post">
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

                                        </td>
                                    </tr>
                                @empty

                                    <tr class="">
                                        <td scope="row" colspan="8">Nothing Found</td>

                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>


    </section>
@endsection
