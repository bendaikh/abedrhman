<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Abedrhman - Laravel with Vue & Blade</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-2">
                Abedrhman Application
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                Laravel with Blade Templates and Vue.js Components
            </p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Vue Component Example -->
            <div>
                <ExampleComponent></ExampleComponent>
            </div>

            <!-- Counter Component -->
            <div>
                <CounterComponent></CounterComponent>
            </div>

            <!-- Todo List Component -->
            <div class="md:col-span-2 lg:col-span-1">
                <TodoListComponent></TodoListComponent>
            </div>
        </div>

        <!-- Blade Template Example -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">
                Blade Template Example
            </h2>
            <p class="text-gray-600 dark:text-gray-300 mb-4">
                This content is rendered using Blade templates. You can mix Blade and Vue components seamlessly!
            </p>
            <div class="space-y-2">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    <strong>Server Time:</strong> {{ now()->format('Y-m-d H:i:s') }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    <strong>Laravel Version:</strong> {{ app()->version() }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    <strong>PHP Version:</strong> {{ PHP_VERSION }}
                </p>
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


