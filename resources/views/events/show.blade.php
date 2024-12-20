@extends('layouts.app')

@section('content')
<div class="container mx-auto my-8 px-4">
    <!-- Event Card -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <!-- Event Image -->
        <div class="relative">
            <img src="{{ $event->image_url ? asset('storage/' . $event->image_url) : asset('images/placeholder.svg') }}" 
                 alt="{{ $event->title }}" 
                 class="w-full h-64 object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <h1 class="text-white text-3xl font-bold">{{ $event->title }}</h1>
            </div>
        </div>

        <!-- Event Details -->
        <div class="p-6">
            <!-- Description -->
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Description</h2>
                <p class="text-gray-600 mt-2">{{ $event->description }}</p>
            </div>

            <!-- Location -->
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Location</h2>
                <p class="text-gray-600 mt-2">{{ $event->location }}</p>
            </div>

            <!-- Dates -->
            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Start Time</h2>
                    <p class="text-gray-600 mt-2">{{ \Carbon\Carbon::parse($event->start_time)->format('F j, Y, g:i A') }}</p>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">End Time</h2>
                    <p class="text-gray-600 mt-2">{{ \Carbon\Carbon::parse($event->end_time)->format('F j, Y, g:i A') }}</p>
                </div>
            </div>

            <!-- Capacity -->
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Capacity</h2>
                <p class="text-gray-600 mt-2">{{ $event->capacity }} participants</p>

                <!-- Event Status -->
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

            <!-- Price -->
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Price</h2>
                <p class="text-gray-600 mt-2">
                    {{ $event->price == 0 ? 'Free' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                </p>
            </div>

            <div class="mt-6">
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <!-- Edit Event Button -->
                    <a href="{{ route('events.edit', $event->id) }}" 
                    class="block text-center bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg">
                        Edit Event
                    </a>
                @else
                    @if ($event->status === 'finished')
                        <button class="block w-full text-center bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg cursor-not-allowed" disabled>
                            Event Finished
                        </button>
                    @elseif (auth()->user()->registrations->contains('event_id', $event->id))
                        <button class="block w-full text-center bg-green-500 text-white font-semibold py-2 px-4 rounded-lg cursor-not-allowed" disabled>
                            Already Registered
                        </button>
                    @elseif ($event->registrants >= $event->capacity)
                        <button class="block w-full text-center bg-gray-400 text-white font-semibold py-2 px-4 rounded-lg cursor-not-allowed" disabled>
                            Fully Booked
                        </button>
                    @else
                        <form action="{{ route('events.register', $event->id) }}" method="POST" class="inline-block w-full">
                            @csrf
                            <button type="submit" 
                                class="block w-full text-center px-4 py-2 border border-black rounded-lg bg-black text-white hover:bg-white hover:text-black transition">
                                Register for Event
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>

    @if(auth()->check() && auth()->user()->role === 'admin')
        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Participant List</h2>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Username</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Email</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Age</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Gender</th>
                        <th class="px-4 py-2 border-b text-left text-sm font-semibold text-gray-600">Registration Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($event->registrations as $registration)
                        <tr>
                            <td class="py-2 px-4 border-b text-gray-700">{{ $registration->user->username }}</td>
                            <td class="py-2 px-4 border-b text-gray-700">{{ $registration->user->email }}</td>
                            <td class="py-2 px-4 border-b text-gray-700">{{ $registration->user->age }}</td>
                            <td class="py-2 px-4 border-b text-gray-700">{{ ucfirst($registration->user->gender) }}</td>
                            <td class="px-4 py-2 border-b text-gray-700">{{ \Carbon\Carbon::parse($registration->registration_date)->format('j F Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-2 px-4 text-center text-gray-500">No participants registered yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection