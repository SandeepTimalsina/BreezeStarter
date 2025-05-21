<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Role') }}
            </h2>
            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" >Name</x-input-label>
                            <div class="mb-3">
                                <x-text-input value="{{ old('name', $user->name) }}" name="name" placeholder="Enter name" type="text" class="w-1/3"/>
                                

                                @error('name')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <x-input-label for="email" >Email</x-input-label>
                            <div class="mb-3">
                                <x-text-input value="{{ old('email', $user->email) }}" name="email" placeholder="Enter Email" type="text"  class="w-1/3"/>

                                @error('email')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-4 mb-3">
                                @if($roles->isNotEmpty())
                                @foreach ($roles as $role)
                                <div class="mt-3">
                                    <input type="checkbox" name="role[]" id="role-{{ $role->id }}" class="rounded"  value="{{ $role->name }}"
                                    {{ $hasRoles->contains($role->id ) ? 'checked' : '' }}>
                                    <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                </div> 
                                @endforeach
                                @endif
                            </div>

                            <x-primary-button class="bg-slate-700 text-sm rounded-md mt-4">Update</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>