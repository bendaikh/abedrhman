<template>
    <a
        :href="item.route"
        :class="[
            'flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200',
            isActive 
                ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300' 
                : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700',
            isCollapsed && 'justify-center px-2'
        ]"
        :title="isCollapsed ? item.title : ''"
    >
        <svg 
            class="flex-shrink-0 w-5 h-5" 
            fill="none" 
            stroke="currentColor" 
            viewBox="0 0 24 24"
        >
            <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                :stroke-width="isActive ? '2' : '1.5'" 
                :d="item.icon" 
            />
        </svg>
        <span 
            v-if="!isCollapsed" 
            class="ml-3 truncate"
        >
            {{ item.title }}
        </span>
        <span 
            v-if="isActive && !isCollapsed" 
            class="ml-auto"
        >
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
        </span>
    </a>
</template>

<script setup>
defineProps({
    item: {
        type: Object,
        required: true
    },
    isCollapsed: {
        type: Boolean,
        default: false
    },
    isActive: {
        type: Boolean,
        default: false
    }
})
</script>

