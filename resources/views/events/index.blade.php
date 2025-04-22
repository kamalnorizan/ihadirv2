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
                        </tr>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->eventCategory->category }}</td>
                                <td>{{ $event->owner->name }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script></script>
@endsection
