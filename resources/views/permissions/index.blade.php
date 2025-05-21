<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Permissions') }}
            </h2>
            <x-profilecontroller></x-profilecontroller>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-medium">Permission List</h3>
                        @can('create permissions')
                            <x-link-button :href="route('permissions.create')">Add Permission</x-link-button>
                        @endcan
                    </div>

                    <x-table :headers="['S.N', 'Name', 'Created At', 'Actions']">
                        @foreach($permissions as $permission)
                            <x-table-row>
                                <x-table-cell>{{ $loop->iteration }}</x-table-cell>
                                <x-table-cell>{{ $permission->name }}</x-table-cell>
                                <x-table-cell>{{ \Carbon\Carbon::parse($permission->created_at)->format('d M Y') }}</x-table-cell>
                                <x-table-cell>
                                    <x-action-button>
                                    @can('edit permissions')
                                        <x-link-button :href="route('permissions.edit', $permission->id)">Edit</x-link-button>
                                    @endcan
                                    @can('delete permissions')
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button type="submit">Delete</x-danger-button>
                                        </form>
                                    @endcan
                                    </x-action-button>
                                </x-table-cell>
                            </x-table-row>
                        @endforeach
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
