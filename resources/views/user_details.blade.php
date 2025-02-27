@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>User Details</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>{{ $user->role }}</td>
                    </tr>
                    
                </table>
                @if ($user->role == 'admin' && $user->permissions->isNotEmpty())
                    <div class="mb-3">
                        <label class="form-label">Permissions:</label>
                        <ul class="list-group">
                            @foreach ($user->permissions as $permission)
                                <li class="list-group-item">{{ ucfirst(str_replace('_', ' ', $permission->name)) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
            </div>
        </div>
    </div>

@endsection
