@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.css">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">title</a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    title
                </div>
                <div class="card-body">
                    <table class="table" id="eventsTbl">
                        <thead>
                            <tr>
                                <td>Bil</td>
                                <td>Title</td>
                                <td>Category</td>
                                <td>Owner</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($events as $event)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->eventCategory->category }}</td>
                                    <td>{{ $event->owner->name }}</td>
                                    <td>
                                        <a href="{{ route('events.show', $event->uuid) }}"
                                            class="btn btn-sm btn-warning">Show</a>
                                        <a href="{{ route('events.edit', $event->uuid) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger btn-delete"
                                            data-uuid="{{ $event->uuid }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script>
        // $('#eventsTbl').DataTable();
        var eventsTbl= $('#eventsTbl').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "type": "POST",
                "url": "{{ route('events.ajaxLoadEventsTbl') }}",
                "dataType": "json",
                "data": function(d) {
                    d._token = "{{ csrf_token() }}";
                },
                error: function(xhr, error, code) {
                    if (xhr.status === 419) {
                        window.location.reload();
                    } else {
                        console.error('An error occurred:', error);
                    }
                }
            },
            "columns": [{
                    "data": null,
                    "name": null,
                    "orderable": false,
                },
                {
                    "data": "title",
                    "name": "title"
                },
                {
                    "data": "category"
                },
                {
                    "data": "owner",
                    "name": "owner.name"
                },
                {
                    "data": "action",
                    "searchable": false,
                    "orderable": false,
                },
            ]
        });

        $('.btn-delete').click(function(e) {
            e.preventDefault();
            var uuid = $(this).data('uuid');
            var url = "{{ route('events.destroy', ':uuid') }}";
            url = url.replace(':uuid', uuid);

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this event again!",
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
                if (value == true) {
                    var form = $('<form>', {
                        'action': url,
                        'method': 'POST'
                    });
                    form.append('{{ csrf_field() }}');
                    form.append('{{ method_field('DELETE') }}');
                    form.appendTo('body').submit();
                }
            });
        });
    </script>
@endsection
