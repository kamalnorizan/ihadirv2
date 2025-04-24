@extends('layouts.app')

@section('head')
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
                    <table class="table">
                        <tr>
                            <td>Bil</td>
                            <td>Title</td>
                            <td>Category</td>
                            <td>Owner</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->eventCategory->category }}</td>
                                <td>{{ $event->owner->name }}</td>
                                <td>
                                    <a href="{{ route('events.edit', $event->uuid) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger btn-delete" data-uuid="{{$event->uuid}}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.btn-delete').click(function (e) {
            e.preventDefault();
            var uuid = $(this).data('uuid');
            var url = "{{ route('events.destroy', ':uuid') }}";
            url = url.replace(':uuid', uuid);

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this event again!",
                icon: "warning",
                buttons: {cancel: {
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
                }}
            }).then((value)=>{
                if(value==true){
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
