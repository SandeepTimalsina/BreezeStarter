<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Goals Management') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class=" font-sans antialiased">
    <div class="min-h-screen flex flex-col md:flex-row">
        {{-- Sidebar --}}
        <aside x-data="{ open: false }" class="w-full md:w-64 bg-white dark:bg-gray-800 border-b md:border-r border-gray-100 dark:border-gray-700">
            <nav class="p-5">
                {{-- Hamburger Menu Button (Mobile Only) --}}
                <div class="flex md:hidden justify-end">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Navigation Content --}}
                @include('layouts.nav')
            </nav>
        </aside>

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col">
            {{-- Top Navigation --}}
            @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $header }}</h1>
                </div>
            </header>
            @endisset
            {{-- Page Content --}}
            <main class="flex-1 p-6 bg-gray-50 dark:bg-gray-900">
                <div class="max-w-7xl mx-auto">
                    @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 ">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 ">
                        <p>{{ session('success') }}</p>
                    </div>
                    @endif
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

</body>

</html>