@extends('layouts.app')

@section('head')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Create New Event</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                Create New Event
            </div>
            <div class="card-body">
                <form action="{{route('events.update', ['event'=>$event->uuid])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}"  class="form-control" placeholder="Enter the title of the event">
                        <small class="text-danger">{{ $errors->first('title') }}</small>
                    </div>

                    <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}"  class="form-control" placeholder="Enter event location">
                        <small class="text-danger">{{ $errors->first('location') }}</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('event_category_id') ? 'has-error' : '' }}">
                                <label for="event_category_id">Category</label>
                                <select id="event_category_id" name="event_category_id" class="form-control"  >
                                    <option value="">Select Category</option>
                                    @foreach ($eventCategories as $key =>$category)
                                        <option value="{{ $key }}" {{ (old('event_category_id', $event->event_category_id) == $key) ? 'selected' : '' }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{ $errors->first('event_category_id') }}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('pax') ? 'has-error' : '' }}">
                                <label for="pax">Total Pax</label>
                                <input type="number" id="pax" value="{{ old('pax', $event->pax) }}" name="pax" class="form-control" >
                                <small class="text-danger">{{ $errors->first('pax') }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control">{{ old('description', $event->description) }} </textarea>
                        <small class="text-danger">{{ $errors->first('description') }}</small>
                    </div>
                    <hr>
                    <h4>Tarikh Event <button class="btn btn-sm btn-info" type="button" id="tambahTarikhBtn">Tambah Tarikh</button></h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="tarikhEventDiv">

                                @if (old('tarikh',$event->eventDates))
                                    @foreach (old('tarikh',$event->eventDates->pluck('event_date')) as $key => $value)
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="date" name="tarikh[]" class="form-control" value="{{ $value }}">
                                                    @error('tarikh.'.$key)
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-danger removeTarikhBtn" type="button">Hapus</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary float-right" id="submitBtn" type="submit">Hantar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#tambahTarikhBtn').click(function (e) {
        e.preventDefault();
        var tarikhEventDiv = $('#tarikhEventDiv');
        $(tarikhEventDiv).append(
            '<div class="row">'+
            '<div class="col-md-8">'+
            '    <div class="form-group ">'+
            '        <input type="date" id="tarikh[]" name="tarikh[]" class="form-control">'+
            '        <small class="text-danger"></small>'+
            '    </div>'+
            '</div>'+
            '<div class="col-md-4">'+
            '    <button class="btn btn-danger removeTarikhBtn" type="button">Hapus</button>'+
            '</div>'+
            '</div>'
        );
    });

    $(document).on("click",".removeTarikhBtn",function (e) {
        e.preventDefault();
        $(this).closest('.row').remove();
    });
</script>
@endsection

