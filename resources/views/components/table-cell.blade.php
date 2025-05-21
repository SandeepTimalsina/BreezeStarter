@props(['align' => 'left'])

<td class="border border-gray-300 px-4 py-2 dark:text-gray-200 {{ $align === 'center' ? 'text-center' : '' }} {{ $align === 'right' ? 'text-right' : '' }}">
    {{ $slot }}
</td>
