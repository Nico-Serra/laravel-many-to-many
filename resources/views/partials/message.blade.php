@if (session('message'))
    <div class="alert alert-success d-flex justify-content-between ">
        <p>{{ session('message') }}</p>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
