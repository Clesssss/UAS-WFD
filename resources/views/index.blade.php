@extends('layouts.app')

@section('content')

<section class="bg-white relative">
    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl">Connect, Share, and Create Memories.</h1>
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">Discover events that bring people together in meaningful ways. From intimate gatherings to shared experiences, find the perfect event to create lasting memories. Don’t miss out—explore all events now.</p>
            <a href="{{ route('events.index')}}" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100">
                View Events
            </a>
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex relative">
            <div class="absolute -inset-20 bg-gradient-to-br from-black/40 to-transparent rounded-full blur-3xl opacity-80"></div>
            <img src="{{ asset('Gathering.jpg') }}" alt="Gathering" class="relative z-10">
        </div>                   
    </div>
</section>

@endsection