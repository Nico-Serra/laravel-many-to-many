@extends('layouts.admin')


@section('content')
    <section class="bg-light py-3">
        <div class="container d-flex align-items-center justify-content-between py-3">
            <h1>Type</h1>

            <a href="{{ route('admin.types.create') }}" class="btn btn-secondary  ">Add Type</a>
        </div>



        <div class="container text-center ">
            @include('partials.message')

            <div class="table-responsive">
                <table class="table table-secondary w-75 mx-auto">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Actions</th>


                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($types as $type)
                            <tr class="">
                                <td>{{ $type->id }}</td>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->slug }}</td>
                                <td>
                                    <a href="{{ route('admin.types.show', $type) }}" class="btn btn-dark btn-sm">👁‍🗨View
                                        All Projects Type</a>
                                    <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-dark btn-sm">🖊Edit</a>
                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $type->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modalId-{{ $type->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId-{{ $type->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId-{{ $type->id }}">
                                                        You want to delete this type
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">{{ $type->name }}</div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <form action="{{ route('admin.types.destroy', $type) }}"
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


    </section>
@endsection
