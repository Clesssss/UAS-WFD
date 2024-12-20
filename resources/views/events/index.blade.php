@extends('layouts.app')

@section('content')
    <section class="p-16">
        <h1 class="text-4xl font-extrabold text-center mb-8">Events</h1>

        @if(auth()->check() && auth()->user()->role === 'admin')
            <div class="flex justify-center my-8">
                <a href="{{ route('events.create') }}" 
                class="inline-flex items-center px-6 py-2 border border-black rounded-lg bg-black text-white hover:bg-white hover:text-black transition">
                    Add Event
                </a>
            </div>
        @endif

        <div class="flex justify-center mb-8">
            <a href="{{ route('events.index', ['status' => 'ongoing']) }}"
            class="px-6 py-2 mx-1 border border-black rounded-l-lg {{ request('status', 'ongoing') == 'ongoing' ? 'bg-black text-white' : 'bg-white text-black' }} hover:bg-gray-200 transition">
                Ongoing
            </a>
            <a href="{{ route('events.index', ['status' => 'upcoming']) }}"
            class="px-6 py-2 mx-0 border border-black {{ request('status') == 'upcoming' ? 'bg-black text-white' : 'bg-white text-black' }} hover:bg-gray-200 transition">
                Upcoming
            </a>
            <a href="{{ route('events.index', ['status' => 'finished']) }}"
            class="px-6 py-2 mx-1 border border-black rounded-r-lg {{ request('status') == 'finished' ? 'bg-black text-white' : 'bg-white text-black' }} hover:bg-gray-200 transition">
                Finished
            </a>
        </div>

        @if ($events->isEmpty())
            <div class="flex flex-col items-center justify-center text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-48 h-48 mb-6 text-black" viewBox="0 0 24 24" fill="currentColor">
                    <!-- Circle -->
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none" />
                    <!-- Diagonal Line -->
                    <line x1="4" y1="4" x2="20" y2="20" stroke="currentColor" stroke-width="2" />
                </svg>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">No Events Found</h2>
                <p class="text-gray-600 mb-4">It seems like there are no events available at the moment.</p>
                <a href="{{ route('index') }}" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100">
                Back to Home
            </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">  
                @foreach($events as $event)
                    <a href="{{ route('events.show', $event->id) }}" class="group block rounded-lg overflow-hidden shadow-lg transition-transform transform hover:scale-105">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $event->image_url) }}" alt="{{ $event->title }}" class="w-full h-56 object-cover">
                            <div class="absolute inset-0 bg-black opacity-25 group-hover:opacity-50 transition-opacity"></div>
                        </div>
                        <div class="p-4 flex flex-col justify-between h-full">
                            <div class="flex justify-between items-start">
                                <div>
                                    <!-- Event Title -->
                                    <h3 class="text-xl font-semibold text-gray-900 group-hover:text-gray-700">{{ $event->title }}</h3>

                                    <!-- Event Price (Free or Price) -->
                                    <p class="text-lg text-green-600 font-bold mt-2">{{ $event->price ? 'Rp ' . number_format($event->price, 2) : 'Free' }}</p>

                                    <!-- Event Start and End Time -->
                                    <p class="text-sm text-gray-500 mt-1">
                                        @php
                                            $startDate = \Carbon\Carbon::parse($event->start_time);
                                            $endDate = \Carbon\Carbon::parse($event->end_time);
                                        @endphp

                                        @if ($startDate->isSameDay($endDate))
                                            <!-- Same Day -->
                                            {{ $startDate->format('j F Y') . ', ' . $startDate->format('H:i') . ' - ' . $endDate->format('H:i') }}
                                        @elseif ($startDate->isSameMonth($endDate))
                                            <!-- Same Month -->
                                            {{ $startDate->format('j') . ' - ' . $endDate->format('j F Y') }}
                                        @else
                                            <!-- Different Month/Year -->
                                            {{ $startDate->format('j F Y') . ' - ' . $endDate->format('j F Y') }}
                                        @endif  
                                    </p>
                                </div>
                                <p class="text-sm mt-2 font-semibold
                                    @if ($event->capacity)
                                        @if ($event->registrants === null || $event->registrants <= ($event->capacity * 0.2)) 
                                            text-blue-500
                                        @elseif ($event->registrants >= $event->capacity) 
                                            text-red-500
                                        @elseif ($event->registrants >= ($event->capacity * 0.8)) 
                                            text-yellow-500
                                        @else 
                                            text-green-500
                                        @endif
                                    @else
                                        text-gray-500
                                    @endif
                                ">
                                    @if ($event->capacity)
                                        @if ($event->registrants === null || $event->registrants <= ($event->capacity * 0.2))
                                            Spots Available
                                        @elseif ($event->registrants >= $event->capacity)
                                            Fully Booked
                                        @elseif ($event->registrants >= ($event->capacity * 0.8))
                                            Almost Full
                                        @else
                                            Limited Spots Left
                                        @endif
                                    @else
                                        No Capacity Info
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
@endsection