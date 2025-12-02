<template>
    <aside 
        :class="[
            'fixed inset-y-0 left-0 z-50 flex flex-col bg-slate-100 dark:bg-slate-900 border-r border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out shadow-lg',
            isCollapsed ? 'w-20' : 'w-64',
            isMobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
        ]"
    >
        <!-- Sidebar Header -->
        <div class="flex-shrink-0 flex items-center justify-between h-16 px-4 border-b border-gray-200 dark:border-gray-700 bg-slate-50 dark:bg-slate-800">
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

                <!-- Base clientèle and Base tiers -->
                <template v-for="section in serviceSections.slice(0, 2)" :key="section.route">
                    <MenuItem 
                        :item="section" 
                        :is-collapsed="isCollapsed"
                        :is-active="currentRoute === section.route"
                    />
                </template>

                <!-- Services with sub-sections -->
                <CollapsibleMenuItem
                    :item="servicesMenu"
                    :is-collapsed="isCollapsed"
                    :is-open="servicesOpen"
                    :current-route="currentRoute"
                    @toggle="servicesOpen = !servicesOpen"
                />

                <!-- Other sections (Activités, Tarification, etc.) -->
                <template v-for="section in serviceSections.slice(2)" :key="section.route">
                    <MenuItem 
                        :item="section" 
                        :is-collapsed="isCollapsed"
                        :is-active="currentRoute === section.route"
                    />
                </template>

                <!-- Paramètres with sub-sections -->
                <CollapsibleMenuItem
                    :item="parametresMenu"
                    :is-collapsed="isCollapsed"
                    :is-open="parametresOpen"
                    :current-route="currentRoute"
                    @toggle="parametresOpen = !parametresOpen"
                />
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
import CollapsibleMenuItem from './CollapsibleMenuItem.vue'

const isCollapsed = ref(false)
const isMobileOpen = ref(false)
const isMobile = ref(false)
const servicesOpen = ref(false)
const parametresOpen = ref(false)

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
    // Auto-open Services menu if we're on a services or payments route
    if (currentRoute.value.startsWith('/services') || currentRoute.value.startsWith('/payments')) {
        servicesOpen.value = true
    }
    // Auto-open Paramètres menu if we're on a parametres route
    if (currentRoute.value.startsWith('/parametres')) {
        parametresOpen.value = true
    }
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
        title: 'Factures',
        route: '/factures',
        icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'
    },
    {
        title: 'Activités',
        route: '/activites',
        icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'
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
    }
]

// Services menu with sub-sections
const servicesMenu = {
    title: 'Services',
    icon: 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
    children: [
        {
            title: 'Liste des Services',
            route: '/services',
            icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'
        },
        {
            title: 'Paiements',
            route: '/payments',
            icon: 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z'
        }
    ]
}

// Paramètres menu with sub-sections
const parametresMenu = {
    title: 'Paramètres',
    icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
    children: [
        {
            title: 'Dom&Crea Paramètre',
            route: '/parametres',
            icon: 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'
        },
        {
            title: 'List Type Services',
            route: '/parametres/types-services',
            icon: 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
        },
        {
            title: 'List Type Activité',
            route: '/parametres/types-activites',
            icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'
        },
        {
            title: 'Sous-services',
            route: '/parametres/sous-services',
            icon: 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'
        }
    ]
}

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
    
    // Auto-open Services menu if we're on a services or payments route
    if (currentRoute.value.startsWith('/services') || currentRoute.value.startsWith('/payments')) {
        servicesOpen.value = true
    }
    
    // Auto-open Paramètres menu if we're on a parametres route
    if (currentRoute.value.startsWith('/parametres')) {
        parametresOpen.value = true
    }
    
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


