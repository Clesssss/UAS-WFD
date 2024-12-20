<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request) {

        $status = $request->input('status', 'ongoing'); // Default to 'ongoing'

        $events = Event::query()
            ->when($status === 'ongoing', function ($query) {
                $query->where('start_time', '<=', Carbon::now())
                ->where('end_time', '>=', Carbon::now());
            })
            ->when($status === 'upcoming', function ($query) {
                $query->where('start_time', '>', Carbon::now());
            })
            ->when($status === 'finished', function ($query) {
                $query->where('end_time', '<', Carbon::now());
            })
            ->get();

        $perPage = 8; // Jumlah item per halaman
        $currentPage = $request->input('page', 1); // Ambil halaman saat ini, default 1
        $paginatedEvents = $events->slice(($currentPage - 1) * $perPage, $perPage);

        // Simulasi struktur pagination seperti Laravel
        $paginatedEvents = new \Illuminate\Pagination\LengthAwarePaginator(
            $paginatedEvents,
            $events->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('events.index', [
            'events' => $paginatedEvents, compact('events')
        ]);
    }

    public function create()
    {
        return view('events.create');
    }
    
    public function store(StoreEventRequest $request)
    {
        $validatedData = $request->validated();

        $currentDate = now();
        if ($currentDate->isBefore($validatedData['start_time'])) {
            $validatedData['event_status'] = 'upcoming';
        } elseif ($currentDate->isAfter($validatedData['end_time'])) {
            $validatedData['event_status'] = 'finished';
        } else {
            $validatedData['event_status'] = 'ongoing';
        }

        $validatedData['image_url'] = $request->hasFile('image_url')
        ? $request->file('image_url')->store('/events', 'public')
            : 'placeholder.svg';

        $validatedData['price'] = $validatedData['price'] ?? 0;

        Event::create($validatedData);

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    public function show(Event $event)
    {
        return view('events.show', [
            'event' => $event,
        ]);
    }

    public function edit(Event $event)
    {
        return view('events.edit', [
            'event' => $event,
        ]);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $validated = $request->validated();

        $currentDate = now();
        if ($currentDate->isBefore($validated['start_time'])) {
            $validated['event_status'] = 'upcoming';
        } elseif ($currentDate->isAfter($validated['end_time'])) {
            $validated['event_status'] = 'finished';
        } else {
            $validated['event_status'] = 'ongoing';
        }

        if ($request->hasFile('image_url')) {
            $validated['image_url'] = $request->file('image_url')->store('/events', 'public');
        }
        $validated['price'] = $validated['price'] ?? 0;

        $event->update($validated);

        $event->save();

        return redirect()->route('events.show', $event->id)->with('success', 'You have successfully edited the event');
    }
    
    public function register(Request $request, Event $event)
    {
        $user = Auth::user();

        Registration::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'registration_date' => now(),
        ]);

        $event->increment('registrants');
        
        return redirect()->route('events.show', $event->id)->with('success', 'You have successfully registered for the event!');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'You have successfully deleted the event');
    }
}
