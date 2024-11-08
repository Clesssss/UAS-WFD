@extends('base.base')

@section('content')

<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-sm bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Login</h2>
    <form action="#" method="POST">
      <div class="mb-4">
        <label for="role" class="block text-gray-700">Role</label>
        <select name="role" id="role" class="border mt-2 py-2 px-2" >
            <option value="participant">Participant</option>
            <option value="admin">Admin</option>
        </select>
      </div>
      <div class="mb-4">
        <label for="email" class="block text-gray-700">Email</label>
        <input type="email" id="email" name="email" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
      </div>
      <div class="mb-6">
        <label for="password" class="block text-gray-700">Password</label>
        <input type="password" id="password" name="password" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
      </div>
      <button type="submit" class="w-full bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Login</button>
    </form>
    <p class="mt-4 text-sm text-center text-gray-600">Belum punya akun? <a href="#" class="text-blue-600 hover:underline">Daftar di sini</a></p>
  </div>
</div>

@endsection


