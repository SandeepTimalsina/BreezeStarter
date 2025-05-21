<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">


            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
            <x-profilecontroller></x-profilecontroller>
        </div>


    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-medium">Users List</h3>
                        @can('create users')
                        <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Add Users
                        </a>
                        @endcan
                    </div>

                    <table class="w-full border-collapse border border-grey-300 dark:border-gray-600">
                        <thead>
                            <tr class="bg-grey-100 dark:bg-gray-700">
                                <th class="border border-gray-300 px-4 py-2 text-left">S.N</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Email</th>

                                <th class="border border-gray-300 px-4 py-2 text-left">Created At</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="border  border-gray-300 dark:border-gray-600">
                                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>

                                <td class="border border-gray-300 px-4 py-2">{{\Carbon\Carbon::parse($user->created_at )->format('d M Y')}}</td>
                                <td class="border border-gray-300 px-4 ">
                                    @can('edit users')
                                    <a href="{{ route('users.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        Edit and Assign roles
                                    </a>
                                    @endcan

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <div class="my-3">
                            {{ $users->links() }}
                        </div>

                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>