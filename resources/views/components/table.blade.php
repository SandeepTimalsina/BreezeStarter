@props(['headers' => [], 'emptyMessage' => 'No records found.'])

<div class="overflow-x-auto">
    <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
        <thead>
            <tr class="bg-gray-100 dark:bg-gray-700">
                @foreach ($headers as $header)
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold dark:text-gray-200">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @if($slot->isEmpty())
                <tr>
                    <td colspan="{{ count($headers) }}" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                        {{ $emptyMessage }}
                    </td>
                </tr>
            @else
                {{ $slot }}
            @endif
        </tbody>
    </table>
</div>
