<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Ramsey\Uuid\Uuid;
use App\Models\EventDate;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Contracts\DataTable;

class EventController extends Controller
{
    public function index() {
        $events = Event::with('owner', 'eventCategory')->latest()->get();

        $eventCategories = EventCategory::get();
        return view('events.index', compact('events','eventCategories'));
    }

    public function ajaxLoadEventsTbl(Request $request) {
        $events = Event::with('owner', 'eventCategory');

        if($request->has('eventCategory') && $request->eventCategory != '') {
            $events = $events->whereIn('event_category_id', $request->eventCategory);
        }

        return DataTables::of($events)
            ->addColumn('category', function ($event) {
                $category = '<span class="badge badge-success">'.$event->eventCategory->category.'</span>';

                return $category;
            })
            ->addColumn('owner', function ($event) {
                $owner = $event->owner->name;

                return $owner;
            })
            ->addColumn('action', function ($event) {
                $actions = '';
                $actions = $actions . '<a href="'.route('events.show', $event->uuid).'" class="btn btn-sm btn-warning">Show</a> ';

                $actions = $actions . '<a href="'.route('events.edit', $event->uuid).'" class="btn btn-sm btn-primary">Edit</a> ';

                $actions = $actions . '<button type="button" class="btn btn-sm btn-danger btn-delete" data-uuid="'.$event->uuid.'">Delete</button>';

                return $actions;
            })
            ->rawColumns(['action','category'])
            ->make(true);
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

    public function show(Event $event) {

        return view('events.show', compact('event'));
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

    public function destroy(Event $event) {
        $event->eventDates()->delete();
        $event->delete();
        flash('Event Deleted Succesfully')->success()->important();
        return redirect()->route('events.index');
    }
}
