<!-- Desktop Navigation -->
<div class="hidden md:flex flex-col">
    <!-- Navigation Links -->
    <div class="space-y-2">
    <a href="{{ route('dashboard') }}">
                        <x-application-logo class=" flex h-9 w-full fill-current text-gray-800 dark:text-gray-200" />
                    </a>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
            class="flex items-center px-4 py-2 text-sm font-medium rounded-md w-full {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
            {{ __('Dashboard') }}
        </x-nav-link>
        @can('view permissions')
        <x-nav-link :href="route('permissions.index')" :active="request()->routeIs('permissions.index')"
            class="flex items-center px-4 py-2 text-sm font-medium rounded-md w-full {{ request()->routeIs('permissions.index') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
            {{ __('Permissions') }}
        </x-nav-link>
        @endcan
        @can('view roles')
        <x-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.index')"
            class="flex items-center px-4 py-2 text-sm font-medium rounded-md w-full {{ request()->routeIs('roles.index') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
            {{ __('Roles') }}
        </x-nav-link>
        @endcan
        @can('view users')
        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')"
            class="flex items-center px-4 py-2 text-sm font-medium rounded-md w-full {{ request()->routeIs('users.index') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
            {{ __('Users') }}
        </x-nav-link>
        @endcan
    </div>

    
</div>

<!-- Mobile Navigation -->
<div :class="{'block': open, 'hidden': ! open}" class="md:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
        @can('view permissions')
        <x-responsive-nav-link :href="route('permissions.index')" :active="request()->routeIs('permissions.index')">
            {{ __('Permissions') }}
        </x-responsive-nav-link>
        @endcan
        @can('view roles')
        <x-responsive-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.index')">
            {{ __('Roles') }}
        </x-responsive-nav-link>
        @endcan
        @can('view users')
        <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
            {{ __('Users') }}
        </x-responsive-nav-link>
        @endcan
    </div>

    <!-- Mobile Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
        <div class="px-4">
            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
        </div>
        <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</div>