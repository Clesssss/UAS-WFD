@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen my-12 bg-white">
    <div class="w-full max-w-sm bg-white p-6 rounded-lg shadow-2xl">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Edit Profile</h2>
        <form action="{{ route('profile.update', auth()->user()->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Role -->
            <div class="mb-4">
                <label for="role" class="block text-gray-700">Role</label>
                <select name="role" id="role" class="border mt-2 py-2 px-2">
                    <option value="participant" {{ auth()->user()->role == 'participant' ? 'selected' : '' }}>Participant</option>
                    <option value="admin" {{ auth()->user()->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username', auth()->user()->username) }}" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                @error('username')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Age -->
            <div class="mb-6">
                <label for="age" class="block text-gray-700">Age</label>
                <input type="number" id="age" name="age" value="{{ old('age', auth()->user()->age) }}" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                @error('age')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gender -->
            <div class="mb-6">
                <label for="gender" class="block text-gray-700">Gender</label>
                <div class="mt-2">
                    <input type="radio" id="gender_male" name="gender" value="male" class="mr-2" {{ auth()->user()->gender == 'male' ? 'checked' : '' }} required> Male
                    <input type="radio" id="gender_female" name="gender" value="female" class="ml-4 mr-2" {{ auth()->user()->gender == 'female' ? 'checked' : '' }} required> Female
                </div>
                @error('gender')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Update Profile</button>
        </form>

        <!-- Link to login if needed -->
        <p class="mt-4 text-sm text-center text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a></p>
    </div>
</div>
@endsection

