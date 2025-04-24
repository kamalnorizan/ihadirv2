<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index() {
        $events = Event::with('owner', 'eventCategory')->get();
        return view('events.index', compact('events'));
    }

    public function create() {
        $eventCategories = EventCategory::pluck('category','id');
        // dd($eventCategories);
        return view('events.create', compact('eventCategories'));
    }

    public function store(Request $request) {
        $request->validate([
            'title'=>'required|min:5',
            'location'=>'required',
            'event_category_id'=>'required|exists:event_categories,id',
            'pax'=>'required|integer',
            'description'=>'required',
        ]);

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

        flash('Event created successfully')->success()->important();

        return redirect()->route('events.index');
    }
}
