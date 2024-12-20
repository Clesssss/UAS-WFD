@extends('layouts.app')

@section('content')

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Event Form -->
                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-medium">Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                placeholder="Enter the event title" 
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                            @error('title')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-medium">Description</label>
                            <textarea id="description" name="description" rows="4"
                                placeholder="Provide a brief description of the event" 
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Start Time -->
                        <div class="mb-4">
                            <label for="start_time" class="block text-gray-700 font-medium">Start Time</label>
                            <input type="datetime-local" id="start_time" name="start_time" value="{{ old('start_time') }}"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                            @error('start_time')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- End Time -->
                        <div class="mb-4">
                            <label for="end_time" class="block text-gray-700 font-medium">End Time</label>
                            <input type="datetime-local" id="end_time" name="end_time" value="{{ old('end_time') }}"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                            @error('end_time')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="mb-4">
                            <label for="location" class="block text-gray-700 font-medium">Location</label>
                            <input type="text" id="location" name="location" value="{{ old('location') }}"
                                placeholder="Enter the event location" 
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                            @error('location')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Capacity -->
                        <div class="mb-4">
                            <label for="capacity" class="block text-gray-700 font-medium">Capacity</label>
                            <input type="number" id="capacity" name="capacity" value="{{ old('capacity') }}"
                                placeholder="Enter the maximum number of participants" 
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                            @error('capacity')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="block text-gray-700 font-medium">Price</label>
                            <input type="number" id="price" name="price" value="{{ old('price') }}"
                                placeholder="Enter the price for the event (0 for free)" 
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                            @error('price')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Thumbnail Image -->
                        <div class="mb-4">
                            <label for="image_url" class="block text-gray-700 font-medium">Thumbnail Image</label>
                            <input type="file" id="image_url" name="image_url" accept="image/*"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                            <p class="text-sm text-gray-500">Upload Image (Max: 2MB)</p>
                            @error('image_url')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                            class="bg-gray-900 text-white px-4 py-2 rounded-md hover:bg-white hover:text-gray-900 hover:border transition-colors">
                            Create Event
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection