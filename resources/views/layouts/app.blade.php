<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <x-navbar/>
        @yield('content')
        <x-footer/>
    </body>
</html>

@yield('script')

<div id="successModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-semibold">Success</h3>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <p class="mt-4 text-gray-700">{{ session('success') }}</p>
        <div class="mt-4 text-right">
            <button id="closeModalBtn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Close</button>
        </div>
    </div>
</div>

<script>
    // Check if the session message exists
    @if(session('success'))
        // Show the modal
        window.onload = function() {
            document.getElementById("successModal").classList.remove("hidden");
        };
    @endif

    // Get the modal element
    var modal = document.getElementById("successModal");

    // Get the close button elements
    var closeModal = document.getElementById("closeModal");
    var closeModalBtn = document.getElementById("closeModalBtn");

    // When the user clicks the close button, hide the modal
    closeModal.onclick = function() {
        modal.classList.add("hidden");
    }

    closeModalBtn.onclick = function() {
        modal.classList.add("hidden");
    }

    // When the user clicks anywhere outside the modal, hide it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.classList.add("hidden");
        }
    }
</script>