<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Permission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="name" class="text-lg font-medium">Name</label>
                            <div class="mb-3">
                                <x-text-input 
                                    value="{{ old('name', $permission->name) }}" 
                                    name="name" 
                                    placeholder="Enter name" 
                                    type="text" 
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg focus:ring focus:ring-blue-200 focus:border-blue-400"
                                />

                                @error('name')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <x-primary-button class="bg-blue-600 text-sm rounded-md mt-4">Update</x-primary-button>
                            <a href="{{ route('permissions.index') }}" class="ml-3 text-sm text-gray-500">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
