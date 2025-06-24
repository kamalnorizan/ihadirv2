@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.11/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.11/css/dataTables.bootstrap4.min.css">
    <style>
        .badge-roles{
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
                                            data-roles="{{ $user->roles->pluck('id') }}" data-toggle="modal"
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
    <script>

        $('.badge-roles').click(function (e) {
            e.preventDefault();
            alert('nak delete?');
        });

        $('#rolepermissionmodel').on('show.bs.modal', function(event) {
            $('.roles').prop('checked', false);

            var button = $(event.relatedTarget);
            var id = button.data('id');
            var roles = button.data('roles');
            $('#user_id').val(id);
            $.each(roles, function(indexInArray, valueOfElement) {
                $('#role_' + valueOfElement).prop('checked', true);
            });
        });

        $('#saveBtnRole').click(function(e) {
            e.preventDefault();
            var roles = [];
            $('.roles:checked').each(function() {
                roles.push($(this).val());
            });

            $.ajax({
                type: "post",
                url: "{{ route('users.assignRole') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    roles: roles,
                    user_id: $('#user_id').val()
                },
                dataType: "json",
                success: function (response) {
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
