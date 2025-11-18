<template>
    <div class="relative">
        <!-- Parent Menu Item -->
        <button
            @click="$emit('toggle')"
            :class="[
                'w-full flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200',
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
                    stroke-width="1.5" 
                    :d="item.icon" 
                />
            </svg>
            <span 
                v-if="!isCollapsed" 
                class="ml-3 flex-1 text-left truncate"
            >
                {{ item.title }}
            </span>
            <svg 
                v-if="!isCollapsed"
                :class="[
                    'ml-2 w-4 h-4 transition-transform duration-200',
                    isOpen ? 'transform rotate-90' : ''
                ]"
                fill="none" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <!-- Submenu Items -->
        <div
            v-if="isOpen && !isCollapsed"
            class="mt-1 ml-4 space-y-1 border-l-2 border-gray-200 dark:border-gray-700 pl-4"
        >
            <a
                v-for="child in item.children"
                :key="child.route"
                :href="child.route"
                :class="[
                    'flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200',
                    isChildActive(child.route)
                        ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300'
                        : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'
                ]"
            >
                <svg 
                    class="flex-shrink-0 w-4 h-4 mr-3" 
                    fill="none" 
                    stroke="currentColor" 
                    viewBox="0 0 24 24"
                >
                    <path 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        stroke-width="1.5" 
                        :d="child.icon || 'M9 5l7 7-7 7'" 
                    />
                </svg>
                <span class="truncate">{{ child.title }}</span>
            </a>
        </div>

        <!-- Collapsed Submenu (Tooltip/Popover) -->
        <div
            v-if="isCollapsed && isOpen"
            class="absolute left-full ml-2 top-0 py-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 z-50"
        >
            <a
                v-for="child in item.children"
                :key="child.route"
                :href="child.route"
                :class="[
                    'block px-4 py-2 text-sm rounded-lg transition-colors duration-200',
                    isChildActive(child.route)
                        ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300'
                        : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'
                ]"
            >
                {{ child.title }}
            </a>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    item: {
        type: Object,
        required: true
    },
    isCollapsed: {
        type: Boolean,
        default: false
    },
    isOpen: {
        type: Boolean,
        default: false
    },
    currentRoute: {
        type: String,
        default: '/'
    }
})

defineEmits(['toggle'])

const normalize = (value = '') => value.replace(/\/+$/, '')

const isChildActive = (childRoute = '/') => {
    const current = props.currentRoute || '/'
    if (childRoute.includes('#')) {
        return current === childRoute
    }

    const normalizedCurrent = normalize(current.split('#')[0])
    const normalizedChild = normalize(childRoute)
    return normalizedCurrent === normalizedChild || normalizedCurrent.startsWith(`${normalizedChild}/`)
}

const isActive = computed(() => {
    return props.item.children?.some(child => isChildActive(child.route)) || false
})
</script>

