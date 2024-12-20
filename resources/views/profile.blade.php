@extends('layouts.app')

@section("content")

<div class="container mx-auto my-8 px-4">
    <!-- Profile Card -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Profile</h1>

            <!-- User Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Username</h2>
                    <p class="text-gray-600 mt-2">{{ auth()->user()->username }}</p>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Email</h2>
                    <p class="text-gray-600 mt-2">{{ auth()->user()->email }}</p>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Role</h2>
                    <p class="text-gray-600 mt-2">{{ ucfirst(auth()->user()->role) }}</p>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Account Created On</h2>
                    <p class="text-gray-600 mt-2">{{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('F j, Y') }}</p>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Age</h2>
                    <p class="text-gray-600 mt-2">{{ auth()->user()->age ?? 'N/A' }}</p>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Gender</h2>
                    <p class="text-gray-600 mt-2">{{ ucfirst(auth()->user()->gender ?? 'N/A') }}</p>
                </div>
            </div>
            <a href="{{ route('profile.edit', auth()->user()->id) }}" 
                class="block text-center mt-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg">
                    Edit Profile
            </a>
        </div>
    </div>

    <!-- Registration List -->
    @if(auth()->user()->role == 'participant')
        <!-- Active Events -->
        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Active Events</h2>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Event Name</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Start Time</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (auth()->user()->registrations->filter(fn($registration) => $registration->event->status === 'upcoming' || $registration->event->status === 'ongoing') as $registration)
                        <tr>
                            <td class="py-2 px-4 border-b text-gray-700">{{ $registration->event->title }}</td>
                            <td class="py-2 px-4 border-b text-gray-700">
                               {{ \Carbon\Carbon::parse($registration->event->start_time)->format('d F Y \a\t H:i') }}
                            </td>
                            <td class="py-2 px-4 border-b text-gray-700">
                                <a href="{{ route('events.show', $registration->event->id) }}" 
                                class="text-blue-500 hover:underline">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-2 px-4 text-center text-gray-500">No active events found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Completed Events -->
        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Completed Events</h2>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Event Name</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Start Time</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (auth()->user()->registrations->filter(fn($registration) => $registration->event->status === 'finished') as $registration)
                        <tr>
                            <td class="py-2 px-4 border-b text-gray-700">{{ $registration->event->title }}</td>
                            <td class="py-2 px-4 border-b text-gray-700">
                                {{ \Carbon\Carbon::parse($registration->event->start_time)->format('d F Y \a\t H:i') }}
                            </td>
                            <td class="py-2 px-4 border-b text-gray-700">
                                <a href="{{ route('events.show', $registration->event->id) }}" 
                                class="text-blue-500 hover:underline">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-2 px-4 text-center text-gray-500">No completed events found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
    
</div>

@endsection
