@extends('layouts.main')

@section('content')

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <input type="checkbox" name="" id="" checked>
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
    </div>
    
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
    </div>
    
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
    </div> 
    <div class="mb-3">
        <label class="form-label">Role</label>
        <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" disabled>
    </div>
    
    @if($user->role == 'admin')
    <div class="mb-3">
        <label class="form-label">Permissions</label>
        <div class="form-check">
            @foreach(['create_products', 'edit_products', 'delete_products', 'view_products', 'create_users', 'edit_users', 'delete_users', 'view_users'] as $permission)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission }}" 
                        {{ $user->permissions->pluck('name')->contains($permission) ? 'checked' : '' }} style="left: 0 !important;">
                    <label class="form-check-label">{{ ucfirst(str_replace('_', ' ', $permission)) }}</label>
                </div>
            @endforeach
        </div>
    </div>
@endif

    
    <button type="submit" class="btn btn-primary">Update User</button>
</form>


@endsection