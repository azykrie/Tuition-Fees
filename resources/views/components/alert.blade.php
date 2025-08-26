@props([
    'type' => 'success', // success | error | warning | info
    'message' => '',
    'duration' => 5, // detik countdown
])

@php
    $styles = [
        'success' =>
            'text-green-800 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800',
        'error' => 'text-red-800 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800',
        'warning' =>
            'text-yellow-800 border-yellow-300 bg-yellow-50 dark:text-yellow-400 dark:bg-gray-800 dark:border-yellow-800',
        'info' => 'text-blue-800 border-blue-300 bg-blue-50 dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800',
    ];

    $icons = [
        'success' =>
            '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9 14l-4-4 1.41-1.41L9 11.17l4.59-4.58L15 8l-6 6Z"/>',
        'error' =>
            '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM7.05 6.05 10 9l2.95-2.95 1.41 1.41L11.41 10.5l2.95 2.95-1.41 1.41L10 11.41l-2.95 2.95-1.41-1.41L8.59 10.5 5.64 7.55l1.41-1.41Z"/>',
        'warning' =>
            '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 14a1.25 1.25 0 1 1 0-2.5A1.25 1.25 0 0 1 10 14.5Zm1-4.5H9V5h2v5Z"/>',
        'info' =>
            '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 3a1.25 1.25 0 1 1 0 2.5A1.25 1.25 0 0 1 10 3.5Zm1 11h-2v-6h2v6Z"/>',
    ];
@endphp

<div class="fixed top-5 right-5 z-50">
    <div id="alert" class="flex items-center p-3 text-sm border rounded-lg shadow-lg {{ $styles[$type] }}"
        role="alert">
        <svg class="shrink-0 w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            {!! $icons[$type] !!}
        </svg>
        <div class="ms-2 font-medium">
            {!! $message !!} <span id="countdown">({{ $duration }})</span>
        </div>
        <button type="button"
            class="ms-auto -mx-1 -my-1 bg-transparent rounded-lg focus:ring-2 p-1.5 hover:bg-gray-200 dark:hover:bg-gray-700"
            onclick="document.getElementById('alert').remove()" aria-label="Close">
            ✕
        </button>
    </div>
</div>


<script>
    let timeLeft = {{ $duration }};
    const countdown = document.getElementById("countdown");
    const alertBox = document.getElementById("alert");

    const timer = setInterval(() => {
        timeLeft--;
        if (countdown) countdown.textContent = `(${timeLeft})`;

        if (timeLeft <= 0) {
            clearInterval(timer);
            if (alertBox) alertBox.remove();
        }
    }, 1000);
</script>
