@props(['type' => 'info', 'message'])

@php
    $bgColor = match ($type) {
        'success' => 'bg-green-100 dark:bg-green-800 border-green-400 dark:border-green-600 text-green-700 dark:text-green-400',
        'error' => 'bg-red-100 dark:bg-red-800 border-red-400 dark:border-red-600 text-red-700 dark:text-red-400',
        'warning' => 'bg-yellow-100 dark:bg-yellow-800 border-yellow-400 dark:border-yellow-600 text-yellow-700 dark:text-yellow-400',
        default => 'bg-blue-100 dark:bg-blue-800 border-blue-400 dark:border-blue-600 text-blue-700 dark:text-blue-400',
    };
@endphp

<div class="{{ $bgColor }} border-l-4 p-4" role="alert">
    <p class="font-bold">{{ ucfirst($type) }}</p>
    <p>{{ $message }}</p>
</div>