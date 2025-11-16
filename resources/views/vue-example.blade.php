<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vue Example - Bouyahya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen py-8">
    <div class="container mx-auto px-4 max-w-6xl">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-2">
                Vue.js Components
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                Interactive Vue components integrated with Laravel Blade
            </p>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Example Component -->
            <div>
                <ExampleComponent></ExampleComponent>
            </div>

            <!-- Counter Component -->
            <div>
                <CounterComponent></CounterComponent>
            </div>
        </div>

        <!-- Todo List Component (Full Width) -->
        <div class="mb-6">
            <TodoListComponent></TodoListComponent>
        </div>

        <!-- Information Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">
                About Vue.js Integration
            </h2>
            <div class="space-y-3 text-gray-600 dark:text-gray-400">
                <p>
                    These Vue components are rendered client-side and provide interactive functionality.
                    They work seamlessly alongside Blade templates, allowing you to:
                </p>
                <ul class="list-disc list-inside space-y-2 ml-4">
                    <li>Use Blade for server-side rendering and data binding</li>
                    <li>Use Vue for interactive, client-side components</li>
                    <li>Mix both technologies in the same application</li>
                    <li>Leverage the best of both worlds</li>
                </ul>
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
                    <a href="{{ route('blade-example') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                        Blade Example
                    </a>
                </li>
                <li>
                    <a href="{{ route('vue-example') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-semibold">
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

