<template>
    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">
            Vue Component Example
        </h2>
        <p class="text-gray-600 dark:text-gray-300 mb-4">
            This is a Vue component rendered within a Blade template!
        </p>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Current time: {{ currentTime }}
        </p>
    </div>
</template>

<script>
export default {
    name: 'ExampleComponent',
    data() {
        return {
            currentTime: new Date().toLocaleString()
        }
    },
    mounted() {
        // Update time every second
        setInterval(() => {
            this.currentTime = new Date().toLocaleString();
        }, 1000);
    }
}
</script>

