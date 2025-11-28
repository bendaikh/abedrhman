<template>
    <aside 
        :class="[
            'fixed inset-y-0 left-0 z-50 bg-slate-100 dark:bg-slate-900 border-r border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out shadow-lg',
            isCollapsed ? 'w-20' : 'w-64',
            isMobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
        ]"
    >
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 dark:border-gray-700 bg-slate-50 dark:bg-slate-800">
            <div v-if="!isCollapsed" class="flex items-center space-x-2">
                <div class="h-8 w-8 rounded-lg bg-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <span class="text-xl font-bold text-gray-800 dark:text-white">Abedrhman</span>
            </div>
            <button 
                @click="toggleCollapse"
                class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300"
                v-if="!isMobile"
            >
                <svg :class="['w-5 h-5 transition-transform', isCollapsed ? 'rotate-180' : '']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
            </button>
            <button 
                @click="closeMobile"
                class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 lg:hidden"
                v-if="isMobile"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 overflow-y-auto py-4 px-2">
            <div class="space-y-1">
                <!-- Dashboard -->
                <MenuItem 
                    :item="menuItems.dashboard" 
                    :is-collapsed="isCollapsed"
                    :is-active="currentRoute.startsWith(menuItems.dashboard.route)"
                />

                <!-- Sections -->
                <template v-for="section in serviceSections" :key="section.route">
                    <MenuItem 
                        :item="section" 
                        :is-collapsed="isCollapsed"
                        :is-active="currentRoute === section.route"
                    />
                </template>
            </div>
        </nav>
    </aside>

    <!-- Mobile Overlay -->
    <div 
        v-if="isMobile && isMobileOpen"
        @click="closeMobile"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"
    ></div>

    <!-- Mobile Menu Toggle Button -->
    <button 
        @click="openMobile"
        v-if="!isMobileOpen"
        class="fixed top-3 left-3 sm:top-4 sm:left-4 z-50 p-2 bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-800 rounded-lg shadow-lg lg:hidden border border-gray-200 dark:border-gray-700"
    >
        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import MenuItem from './MenuItem.vue'

const isCollapsed = ref(false)
const isMobileOpen = ref(false)
const isMobile = ref(false)

const getCurrentRoute = () => {
    if (typeof window === 'undefined') {
        return '/'
    }
    return window.location.pathname || '/'
}

const currentRoute = ref(getCurrentRoute())

// Update route on navigation
const updateRoute = () => {
    currentRoute.value = getCurrentRoute()
}

const menuItems = {
    dashboard: {
        title: 'Tableau de bord',
        icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
        route: '/dashboard'
    }
}

const serviceSections = [
    {
        title: 'Base clientèle',
        route: '/clients',
        icon: 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M15 11a3 3 0 10-6 0 3 3 0 006 0z'
    },
    {
        title: 'Base tiers',
        route: '/tiers',
        icon: 'M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm3 4h10M7 14h6'
    },
    {
        title: 'Services',
        route: '/services',
        icon: 'M5 13l4 4L19 7'
    },
    {
        title: 'Tarification',
        route: '/tarification',
        icon: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8'
    },
    {
        title: 'Étapes création',
        route: '/etapes-creation',
        icon: 'M7 8h10M7 12h6m-6 4h4'
    },
    {
        title: 'Étapes domiciliation',
        route: '/etapes-domiciliation',
        icon: 'M9 5l7 7-7 7'
    },
    {
        title: 'Paramètres',
        route: '/parametres',
        icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'
    }
]

const toggleCollapse = () => {
    isCollapsed.value = !isCollapsed.value
}

const checkMobile = () => {
    isMobile.value = window.innerWidth < 1024
    if (!isMobile.value) {
        isMobileOpen.value = false
    }
}

const openMobile = () => {
    isMobileOpen.value = true
}

const closeMobile = () => {
    isMobileOpen.value = false
}

let routeCheckInterval = null

onMounted(() => {
    checkMobile()
    window.addEventListener('resize', checkMobile)
    
    // Update route on initial load
    updateRoute()
    
    // Listen for browser back/forward navigation
    window.addEventListener('popstate', updateRoute)
    
    // Since we're using regular links (not Vue Router), the page reloads on navigation
    // But we check periodically in case of any programmatic navigation
    routeCheckInterval = setInterval(() => {
        const newRoute = getCurrentRoute()
        if (newRoute !== currentRoute.value) {
            updateRoute()
        }
    }, 100)
})

onUnmounted(() => {
    window.removeEventListener('resize', checkMobile)
    window.removeEventListener('popstate', updateRoute)
    if (routeCheckInterval) {
        clearInterval(routeCheckInterval)
    }
})
</script>


