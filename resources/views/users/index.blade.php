@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.11/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.11/css/dataTables.bootstrap4.min.css">
    <style>
        .badge-role-permission {
            cursor: pointer;
        }
    </style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Pengurusan Pengguna</a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Role Management</h4>
                    <table class="table table-bordered">
                        <tr>
                            <td>Name</td>
                            <td>Permissions</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions as $permission)
                                        <span class="badge badge-info badge-role-permission"
                                            data-id="{{ $role->id }}">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <button data-permission="{{ $role->permissions->pluck('id') }}"
                                        data-id="{{ $role->id }}" type="button" class="btn btn-primary btn-sm"
                                        data-toggle="modal" data-target="#assignPermissionModal">
                                        Assign Permission
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    Senarai Pengguna
                </div>
                <div class="card-body">
                    <table id="users-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Nama</td>
                                <td>Email</td>
                                <td>Peranan</td>
                                <td>Tindakan</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="badge badge-info badge-roles">{{ $role->name }}</span>
                                        @endforeach
                                        @foreach ($user->permissions as $permission)
                                            <span class="badge badge-warning text-black">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @can('Assign Role Pengguna')
                                            <button type="button" class="btn btn-primary btn-sm" data-id="{{ $user->id }}"
                                                data-roles="{{ $user->roles->pluck('id') }}"
                                                data-permissions="{{ $user->permissions->pluck('id') }}" data-toggle="modal"
                                                data-target="#rolepermissionmodel">
                                                Assign Role/Permission
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="assignPermissionModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Permission/h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <h3>Permissions</h3>
                    <input type="hidden" name="role_model_role_id" id="role_model_role_id" value="value" id="role_model_role_id">
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input permissions_role" type="checkbox"
                                            id="permissions_role_{{ $permission->id }}"
                                            name="permissions_role_{{ $permission->id }}" value="{{ $permission->id }}">
                                        <label class="form-check-label"
                                            for="permissions_role_{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnPermissionRole" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="rolepermissionmodel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Role/Permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="value" id="user_id">
                    <h3>Roles</h3>
                    <div class="row">
                        @foreach ($roles as $role)
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input roles" type="checkbox" id="role_{{ $role->id }}"
                                            name="role_{{ $role->id }}" value="{{ $role->id }}">
                                        <label class="form-check-label"
                                            for="role_{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <h3>Permissions</h3>
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input permissions" type="checkbox"
                                            id="permission_{{ $permission->id }}"
                                            name="permission_{{ $permission->id }}" value="{{ $permission->id }}">
                                        <label class="form-check-label"
                                            for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveBtnRole">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.badge-roles').click(function(e) {
            e.preventDefault();
            alert('nak delete?');
        });

        $('.badge-role-permission').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var name = $(this).text();

            swal({
                title: "Are you sure?",
                text: "Do you want to revoke this permission from role",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Cancel",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Yes, i'm sure!",
                        value: true,
                        visible: true,
                        className: "btn-danger",
                        closeModal: true
                    }
                }
            }).then((value) => {
                // alert(value);
                if (value == true) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('roles.removePermission') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            role_id: id,
                            permission: name
                        },
                        dataType: "json",
                        success: function(response) {
                            swal("Deleted!", "Permission successfully revoked.", "success")
                                .then(() => {
                                    window.location.reload();
                                });
                        }
                    });
                }
            });
        });



        $('#assignPermissionModal').on('show.bs.modal', function(event) {
            $('.permissions_role').prop('checked', false);
            var button = $(event.relatedTarget);
            var role = button.data('id');
            var permissions = button.data('permission');
            $('#role_model_role_id').val(role);
            $.each(permissions, function(indexInArray, valueOfElement) {
                $('#permissions_role_' + valueOfElement).prop('checked', true);
            });
        });

        $('#btnPermissionRole').click(function(e) {
            e.preventDefault();
            var permissions = [];
            $('.permissions_role:checked').each(function() {
                permissions.push($(this).val());
            });
            var role_id = $('#role_model_role_id').val();

            $.ajax({
                type: "post",
                url: "{{ route('roles.assignPermission') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    permissions: permissions,
                    role_id: role_id
                },
                dataType: "json",
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        $('#rolepermissionmodel').on('show.bs.modal', function(event) {
            $('.roles').prop('checked', false);
            $('.permissions').prop('checked', false);

            var button = $(event.relatedTarget);
            var id = button.data('id');
            var roles = button.data('roles');
            var permissions = button.data('permissions');
            $('#user_id').val(id);
            $.each(roles, function(indexInArray, valueOfElement) {
                $('#role_' + valueOfElement).prop('checked', true);
            });
            $.each(permissions, function(indexInArray, valueOfElement) {
                $('#permission_' + valueOfElement).prop('checked', true);
            });
        });

        $('#saveBtnRole').click(function(e) {
            e.preventDefault();
            var roles = [];
            $('.roles:checked').each(function() {
                roles.push($(this).val());
            });
            var permissions = [];
            $('.permissions:checked').each(function() {
                permissions.push($(this).val());
            });


            $.ajax({
                type: "post",
                url: "{{ route('users.assignRole') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    roles: roles,
                    permissions: permissions,
                    user_id: $('#user_id').val()
                },
                dataType: "json",
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        var userTable = $('#users-table').DataTable({
            "order": [
                [0, "asc"]
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": 3
            }],
            "language": {
                "search": "Cari:",
                "lengthMenu": "Paparkan _MENU_ rekod",
                "info": "Memaparkan _START_ hingga _END_ daripada _TOTAL_ rekod",
                "infoEmpty": "Tiada rekod yang ditemui",
                "zeroRecords": "Tiada rekod yang sepadan",
                "paginate": {
                    "next": "Seterusnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    </script>
@endsection
