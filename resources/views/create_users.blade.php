@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h2>Add New User</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

           

            <div class="mb-3">
                <div class="form-group">
                    <label for="pillSelect">Role</label>
                    <select class="form-control input-pill" id="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>

            <div class="mb-3" id="permissions-section" style="display: none;">
                <label class="form-label">Permissions</label>
                <div class="form-check">
                    @foreach ($permissions as $permission)
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input"
                            id="perm-{{ $permission->id }}" style="left: 0;">
                        <label class="form-check-label"
                            for="perm-{{ $permission->id }}">{{ ucfirst($permission->name) }}</label>
                        <br>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let roleSelect = document.getElementById("role");
            let permissionsSection = document.getElementById("permissions-section");

            roleSelect.addEventListener("change", function() {
                if (this.value === "admin") {
                    permissionsSection.style.display = "block";
                } else {
                    permissionsSection.style.display = "none";
                }
            });
        });
    </script>

@endsection
