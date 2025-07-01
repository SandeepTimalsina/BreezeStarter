<x-dropdown class="hidden md:flex" align="left" width="48">
    <x-slot name="trigger">
        <button
            class="flex items-center w-full px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-md transition duration-150 ease-in-out">
            <span class="flex-1 text-left">{{ Auth::user()->name }}</span>
            <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>

    </x-slot>


    <x-slot name="content">
        <x-dropdown-link :href="route('profile.edit')" class="w-full">
            {{ __('Profile') }}
        </x-dropdown-link>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                        this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
        <button onclick="toggleTheme()"
            class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center space-x-2 transition duration-150 ease-in-out">
            <svg id="theme-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <!-- Default icon (will be updated by JS) -->
            </svg>
            <span id="theme-text">{{ __('Toggle Dark Mode') }}</span>
        </button>



    </x-slot>
</x-dropdown>