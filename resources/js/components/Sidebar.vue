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

                <!-- Base clientèle -->
                <MenuItem 
                    :item="baseClienteleItem" 
                    :is-collapsed="isCollapsed"
                    :is-active="currentRoute === baseClienteleItem.route"
                />

                <!-- Base tiers -->
                <MenuItem 
                    :item="baseTiersItem" 
                    :is-collapsed="isCollapsed"
                    :is-active="currentRoute === baseTiersItem.route"
                />

                <!-- Services with sub-sections -->
                <CollapsibleMenuItem
                    :item="servicesMenu"
                    :is-collapsed="isCollapsed"
                    :is-open="servicesOpen"
                    :current-route="currentRoute"
                    @toggle="servicesOpen = !servicesOpen"
                />

                <!-- Gestion financière with sub-sections -->
                <CollapsibleMenuItem
                    :item="gestionFinanciereMenu"
                    :is-collapsed="isCollapsed"
                    :is-open="gestionFinanciereOpen"
                    :current-route="currentRoute"
                    @toggle="gestionFinanciereOpen = !gestionFinanciereOpen"
                />

                <!-- Facturations with sub-sections -->
                <CollapsibleMenuItem
                    :item="facturationsMenu"
                    :is-collapsed="isCollapsed"
                    :is-open="facturationsOpen"
                    :current-route="currentRoute"
                    @toggle="facturationsOpen = !facturationsOpen"
                />

                <!-- Relance & Recouvrement -->
                <MenuItem 
                    :item="relanceRecouvrementItem" 
                    :is-collapsed="isCollapsed"
                    :is-active="currentRoute === relanceRecouvrementItem.route"
                />

                <!-- Actions commerciales with sub-sections -->
                <CollapsibleMenuItem
                    :item="actionsCommercialesMenu"
                    :is-collapsed="isCollapsed"
                    :is-open="actionsCommercialesOpen"
                    :current-route="currentRoute"
                    @toggle="actionsCommercialesOpen = !actionsCommercialesOpen"
                />

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
const gestionFinanciereOpen = ref(false)
const facturationsOpen = ref(false)
const actionsCommercialesOpen = ref(false)
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
    // Auto-open Services menu if we're on a services route
    if (currentRoute.value.startsWith('/services')) {
        servicesOpen.value = true
    }
    // Auto-open Gestion financière menu if we're on relevant routes
    if (currentRoute.value.startsWith('/payments') || currentRoute.value.startsWith('/charges') || currentRoute.value.startsWith('/budget-caisation') || currentRoute.value.startsWith('/rapports-financiers')) {
        gestionFinanciereOpen.value = true
    }
    // Auto-open Facturations menu if we're on relevant routes
    if (currentRoute.value.startsWith('/factures') || currentRoute.value.startsWith('/recus-paiements')) {
        facturationsOpen.value = true
    }
    // Auto-open Actions commerciales menu if we're on relevant routes
    if (currentRoute.value.startsWith('/rendez-vous')) {
        actionsCommercialesOpen.value = true
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

// Base clientèle menu item
const baseClienteleItem = {
    title: 'Base clientèle',
    route: '/clients',
    icon: 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M15 11a3 3 0 10-6 0 3 3 0 006 0z'
}

// Base tiers menu item
const baseTiersItem = {
    title: 'Base tiers',
    route: '/tiers',
    icon: 'M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm3 4h10M7 14h6'
}

// Relance & Recouvrement menu item
const relanceRecouvrementItem = {
    title: 'Relance & Recouvrement',
    route: '/relance-recouvrement',
    icon: 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
}

// Services menu with sub-sections
const servicesMenu = {
    title: 'Services',
    icon: 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
    children: [
        {
            title: 'Liste des Services',
            route: '/services',
            icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'
        }
    ]
}

// Gestion financière menu with sub-sections
const gestionFinanciereMenu = {
    title: 'Gestion financière',
    icon: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 4a9 9 0 110-18 9 9 0 010 18z',
    children: [
        {
            title: 'Encaissement',
            route: '/payments',
            icon: 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z'
        },
        {
            title: 'Les charges',
            route: '/charges',
            icon: 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z'
        },
        {
            title: 'Budget caisation',
            route: '/budget-caisation',
            icon: 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z'
        },
        {
            title: 'Rapports financiers',
            route: '/rapports-financiers',
            icon: 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'
        }
    ]
}

// Facturations menu with sub-sections
const facturationsMenu = {
    title: 'Facturations',
    icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
    children: [
        {
            title: 'Factures',
            route: '/factures',
            icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'
        },
        {
            title: 'Les reçus de paiements',
            route: '/recus-paiements',
            icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'
        }
    ]
}

// Actions commerciales menu with sub-sections
const actionsCommercialesMenu = {
    title: 'Actions commerciales',
    icon: 'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z',
    children: [
        {
            title: 'Rendez-vous',
            route: '/rendez-vous',
            icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'
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
        },
        {
            title: 'Rubriques',
            route: '/parametres/rubriques',
            icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'
        },
        {
            title: 'Types de charge',
            route: '/parametres/types-charge',
            icon: 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'
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


