@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h2>Users List</h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? 'N/A' }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                            @if ($user->role !== 'super_admin')
                                <button type="button" class="btn btn-danger deleteUser" data-user-id="{{ $user->id }}">
                                    Delete User
                                </button>
                            @else
                                <button type="button" class="btn btn-danger" disabled>
                                    Delete User
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <!-- مكتبات JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chartist/0.11.4/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // رسم المخطط البياني (Chartist)
            if ($(".ct-chart").length > 0) {
                var data = {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                    series: [
                        [5, 9, 7, 8, 5]
                    ]
                };

                var options = {
                    low: 0,
                    showArea: true
                };

                var chart = new Chartist.Line(".ct-chart", data, options);

                chart.on("draw", function(ctx) {
                    if (!ctx.element) {
                        console.warn("Skipping tooltip due to missing element.");
                        return;
                    }
                });
            }

            // حذف المستخدم مع تأكيد SweetAlert
            $(".deleteUser").click(function() {
                let userId = $(this).data("user-id");

                Swal.fire({
                    title: "Are you sure",
                    text: "you can not undo this step",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Tes , delete it!",
                    cancelButtonText: "Cancle"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/users/${userId}`,
                            type: "POST",
                            data: {
                                _method: "DELETE",
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire("User deleted successfully", "success")
                                        .then(() => location.reload());
                                } else {
                                    Swal.fire("An error has occured", "error");
                                }
                            },
                            error: function() {
                                Swal.fire("ERROR", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
