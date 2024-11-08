@extends('base.base')

@section('content')
<div class="flex justify-center items-center min-h-screen my-12 bg-white">
    <div class="w-full max-w-sm bg-white p-6 rounded-lg shadow-2xl">
    	<h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Register</h2>
    	<form action="{{ route('register') }}" method="POST">
			@csrf
      		<div class="mb-4">
       			<label for="role" class="block text-gray-700">Role</label>
				<select name="role" id="role" class="border mt-2 py-2 px-2" >
					<option value="participant">Participant</option>
					<option value="admin">Admin</option>
				</select>
				@error('role')
					<span class="text-red-500 text-sm">{{ $message }}</span>
				@enderror
      		</div>
      		<div class="mb-4">
        		<label for="username" class="block text-gray-700">Username</label>
        		<input type="text" id="username" name="username" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
				 @error('name')
					<span class="text-red-500 text-sm">{{ $message }}</span>
				@enderror
			</div>
      		<div class="mb-4">
        		<label for="email" class="block text-gray-700">Email</label>
        		<input type="email" id="email" name="email" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
				@error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
			</div>
      		<div class="mb-6">
        		<label for="password" class="block text-gray-700">Password</label>
        		<input type="password" id="password" name="password" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
				
			</div>
			<div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
      		<div class="mb-6">
        		<label for="age" class="block text-gray-700">Age</label>
        		<input type="number" id="age" name="age" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
				@error('age')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
			</div>
      		<div class="mb-6">
                <label for="gender" class="block text-gray-700">Gender</label>
                <div class="mt-2">
                    <input type="radio" id="gender_male" name="gender" value="male" class="mr-2" required> Male
                    <input type="radio" id="gender_female" name="gender" value="female" class="ml-4 mr-2" required> Female
                </div>
				@error('gender')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
      		<button type="submit" class="w-full bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Register</button>
    	</form>
    	<p class="mt-4 text-sm text-center text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a></p>
  	</div>
</div>


@endsection