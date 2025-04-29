
@extends('layouts.app')

@section('head')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Event Detail</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3>{{ $event->title }}</h3>
            </div>
            <div class="card-body">
                @foreach ($event->eventDates as $eventDate)
                    <div class="row mt-3">
                        <div class="col-md-6">
                           {{\Carbon\Carbon::parse($eventDate->event_date)->format('d-m-Y')}}

                        </div>
                        <div class="col-md-6">
                            {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($eventDate->id) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
</script>
@endsection

