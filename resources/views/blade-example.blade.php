<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blade Example - Abedrhman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen py-8">
    <div class="container mx-auto px-4 max-w-4xl">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-2">
                Blade Template Features
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                Demonstrating Laravel Blade template capabilities
            </p>
        </header>

        <!-- Blade Directives Example -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">
                Blade Directives
            </h2>
            
            <div class="space-y-4">
                <div>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">@if / @elseif / @else</h3>
                    @if(now()->hour < 12)
                        <p class="text-green-600 dark:text-green-400">Good Morning! ☀️</p>
                    @elseif(now()->hour < 18)
                        <p class="text-yellow-600 dark:text-yellow-400">Good Afternoon! 🌤️</p>
                    @else
                        <p class="text-blue-600 dark:text-blue-400">Good Evening! 🌙</p>
                    @endif
                </div>

                <div>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">@foreach Loop</h3>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach(['Laravel', 'Vue.js', 'Blade Templates', 'Tailwind CSS'] as $tech)
                            <li class="text-gray-600 dark:text-gray-400">{{ $tech }}</li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">@php Directive</h3>
                    @php
                        $numbers = [1, 2, 3, 4, 5];
                        $sum = array_sum($numbers);
                    @endphp
                    <p class="text-gray-600 dark:text-gray-400">
                        Sum of [1, 2, 3, 4, 5] = <strong>{{ $sum }}</strong>
                    </p>
                </div>
            </div>
        </div>

        <!-- Blade Components Example -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">
                Server-Side Data
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Current Date</p>
                    <p class="text-lg font-semibold text-gray-800 dark:text-white">
                        {{ now()->format('F j, Y') }}
                    </p>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Current Time</p>
                    <p class="text-lg font-semibold text-gray-800 dark:text-white">
                        {{ now()->format('g:i A') }}
                    </p>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Application Name</p>
                    <p class="text-lg font-semibold text-gray-800 dark:text-white">
                        {{ config('app.name') }}
                    </p>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Environment</p>
                    <p class="text-lg font-semibold text-gray-800 dark:text-white">
                        {{ app()->environment() }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
            <ul class="flex flex-wrap justify-center gap-4">
                <li>
                    <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('blade-example') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-semibold">
                        Blade Example
                    </a>
                </li>
                <li>
                    <a href="{{ route('vue-example') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                        Vue Example
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Vue App Mount Point -->
    <div id="app"></div>
</body>
</html>


