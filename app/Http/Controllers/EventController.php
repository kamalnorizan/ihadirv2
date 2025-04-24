<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;

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
    }
}
