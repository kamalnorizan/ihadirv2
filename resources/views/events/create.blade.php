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
                <form action="{{route('events.store')}}">
                    @csrf
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"  class="form-control" required="required" placeholder="Enter the title of the event">
                        <small class="text-danger">{{ $errors->first('title') }}</small>
                    </div>

                    <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}"  class="form-control" required="required" placeholder="Enter event location">
                        <small class="text-danger">{{ $errors->first('location') }}</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('event_category_id') ? 'has-error' : '' }}">
                                <label for="event_category_id">Category</label>
                                <select id="event_category_id" name="event_category_id" class="form-control" required >
                                    <option value="">Select Category</option>
                                    @foreach ($eventCategories as $key =>$category)
                                        <option value="{{ $key }}" {{ (old('event_category_id') == $key) ? 'selected' : '' }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{ $errors->first('event_category_id') }}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('pax') ? 'has-error' : '' }}">
                                <label for="pax">Total Pax</label>
                                <input type="number" id="pax" value="{{ old('pax') }}" name="pax" class="form-control" required="required" >
                                <small class="text-danger">{{ $errors->first('pax') }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" required="required">{{ old('description') }} </textarea>
                        <small class="text-danger">{{ $errors->first('description') }}</small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
</script>
@endsection

