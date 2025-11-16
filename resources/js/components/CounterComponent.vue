<template>
    <div class="p-6 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-lg text-white">
        <h2 class="text-2xl font-bold mb-4">Vue Counter Component</h2>
        <div class="flex items-center justify-center space-x-4">
            <button 
                @click="decrement"
                class="px-6 py-3 bg-white text-blue-600 rounded-lg font-bold hover:bg-gray-100 transition-colors"
            >
                -
            </button>
            <span class="text-4xl font-bold min-w-[80px] text-center">{{ count }}</span>
            <button 
                @click="increment"
                class="px-6 py-3 bg-white text-blue-600 rounded-lg font-bold hover:bg-gray-100 transition-colors"
            >
                +
            </button>
        </div>
        <p class="text-center mt-4 text-blue-100">
            Click the buttons to increment or decrement the counter
        </p>
    </div>
</template>

<script>
export default {
    name: 'CounterComponent',
    data() {
        return {
            count: 0
        }
    },
    methods: {
        increment() {
            this.count++;
        },
        decrement() {
            this.count--;
        }
    }
}
</script>

