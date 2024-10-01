@extends('layouts.admin')

@section('title', 'Manage Admins')

@section('content')

<div class="heading">
    <h1>Create Admins</h1>
</div>

{{-- Success Messages --}}
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

{{-- Error Messages --}}
@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach
</div>
@endif

<div class="button d-flex justify-content-end">
    {{-- Button to trigger modal --}}
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAdminModal">
        Add New Admin
    </button>
</div>

{{-- Admin Creation Modal --}}
<div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="createAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAdminModalLabel">Create New Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.admins.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    <input type="hidden" name="role" value="admin">

                    <button type="submit" class="btn btn-primary">Create Admin</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Admin List --}}
<div class="card">
    <div class="card-header">
        <h2>Admin List</h2>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" id="adminsTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@push('scripts')

<script>
    $(document).ready(function() {
        $('#adminsTable').DataTable();
    });
</script>
@endpush