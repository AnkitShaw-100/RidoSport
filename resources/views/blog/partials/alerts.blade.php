@if (session('success'))
    <div class="admin-alert admin-alert-success" role="alert">
        <strong>Success!</strong>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if (session('failure'))
    <div class="admin-alert admin-alert-danger" role="alert">
        <strong>Error!</strong>
        <span>{{ session('failure') }}</span>
    </div>
@endif
