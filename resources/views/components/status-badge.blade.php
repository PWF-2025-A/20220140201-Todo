@props(['type'])

@php
    $bgColor = match ($type) {
        'ongoing' => 'bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200',
        'completed' => 'bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200',
        default => 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300',
    };
    $textColor = match ($type) {
        'ongoing' => 'text-blue-800 dark:text-blue-200',
        'completed' => 'text-green-800 dark:text-green-200',
        default => 'text-gray-800 dark:text-gray-300',
    };
@endphp

<span class="{{ $bgColor }} {{ $textColor }} text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
    {{ ucfirst($type) }}
</span>