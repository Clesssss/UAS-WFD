<nav class="bg-white">
  	<div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    	<a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
        	<span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-900">Evently</span>
   	 	</a>	
    	<button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        	<span class="sr-only">Open main menu</span>
        	<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            	<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        	</svg>
    	</button>
    	<div class="hidden w-full md:block md:w-auto" id="navbar-default">
      		<ul class="font-medium flex flex-col p-4 md:p-0 mt-4 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
        		<li>
          			<a href="{{ route('index') }}" class="block py-2 px-3 text-gray-900 md:p-0" aria-current="page">Home</a>
        		</li>
				<li>
          			<a href="{{ route('events.index') }}" class="block py-2 px-3 text-gray-900 md:p-0" aria-current="page">Events</a>
        		</li>
        		@if(Auth::check())
					<li>
          				<a href="{{ route('profile') }}" class="block py-2 px-3 text-gray-900 md:p-0">Profile</a>
        			</li>
        			<li>
          				<a href="{{ route('logout') }}" class="block py-2 px-3 text-gray-400 md:p-0 hover:text-gray-900"
						  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
							@csrf
						</form>
        			</li>
				@else
        			<li>
          				<a href="{{ route('login') }}" class="block py-2 px-3 text-gray-400 md:p-0 hover:text-gray-900">Login</a>
        			</li>
        			<li>
          				<a href="{{ route('register') }}" class="block py-2 px-3 text-gray-400 md:p-0 hover:text-gray-900">Register</a>
        			</li>
				@endif
      		</ul>
    	</div>
  	</div>
</nav>
