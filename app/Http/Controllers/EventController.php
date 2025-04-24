<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Ramsey\Uuid\Uuid;
use App\Models\EventDate;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index() {
        $events = Event::with('owner', 'eventCategory')->latest()->get();
        return view('events.index', compact('events'));
    }

    public function create() {
        $eventCategories = EventCategory::pluck('category','id');
        // dd($eventCategories);
        return view('events.create', compact('eventCategories'));
    }

    public function store(EventRequest $request) {

        $event = new Event();
        $event->uuid = Uuid::uuid4();
        $event->title = $request->title;
        $event->location = $request->location;
        $event->event_category_id = $request->event_category_id;
        $event->pax = $request->pax;
        $event->description = $request->description;
        $event->owner_id = Auth::user()->id;
        $event->email = Auth::user()->email;
        $event->save();

        foreach ($request->tarikh as $key => $tarikh) {
            $eventDate = new EventDate();
            $eventDate->event_id = $event->id;
            $eventDate->event_date = $tarikh;
            $eventDate->save();
        }


        flash('Event created successfully')->success()->important();

        return redirect()->route('events.index');
    }

    public function edit(Event $event) {
        // $event = $uuid;
        $eventCategories = EventCategory::pluck('category','id');
        return view('events.edit', compact('event', 'eventCategories'));
    }

    public function update(EventRequest $request, Event $event) {
        $event->title = $request->title;
        $event->location = $request->location;
        $event->event_category_id = $request->event_category_id;
        $event->pax = $request->pax;
        $event->description = $request->description;
        $event->save();

        $event->eventDates()->delete();

        foreach ($request->tarikh as $key => $tarikh) {
            $eventDate = new EventDate();
            $eventDate->event_id = $event->id;
            $eventDate->event_date = $tarikh;
            $eventDate->save();
        }

        flash('Event Updated Succesfully')->success()->important();
        return redirect()->route('events.index');
    }
}
