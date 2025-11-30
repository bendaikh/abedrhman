<?php $__env->startSection('title', 'Base tiers - Abedrhman'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
        <div class="w-full lg:w-auto">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white">Base tiers</h2>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">
                Gestion centralisée de tous les tiers: fournisseurs, personnel, administrations, partenaires, comptables, bailleurs et comptes associés.
            </p>
        </div>
    </div>

    <!-- Success Message -->
    <?php if(session('success')): ?>
        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Tabs Navigation -->
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="flex flex-wrap -mb-px overflow-x-auto" id="tiers-tabs">
                <button onclick="switchTab('fournisseurs')" 
                    class="tab-button whitespace-nowrap py-4 px-4 sm:px-6 text-sm font-medium border-b-2 transition-colors" 
                    data-tab="fournisseurs">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Fournisseurs
                    </span>
                </button>
                <button onclick="switchTab('personnel')" 
                    class="tab-button whitespace-nowrap py-4 px-4 sm:px-6 text-sm font-medium border-b-2 transition-colors" 
                    data-tab="personnel">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Personnel
                    </span>
                </button>
                <button onclick="switchTab('administrations')" 
                    class="tab-button whitespace-nowrap py-4 px-4 sm:px-6 text-sm font-medium border-b-2 transition-colors" 
                    data-tab="administrations">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                        </svg>
                        Administrations
                    </span>
                </button>
                <button onclick="switchTab('partenaires')" 
                    class="tab-button whitespace-nowrap py-4 px-4 sm:px-6 text-sm font-medium border-b-2 transition-colors" 
                    data-tab="partenaires">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Partenaires
                    </span>
                </button>
                <button onclick="switchTab('comptables')" 
                    class="tab-button whitespace-nowrap py-4 px-4 sm:px-6 text-sm font-medium border-b-2 transition-colors" 
                    data-tab="comptables">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Comptables
                    </span>
                </button>
                <button onclick="switchTab('bailleurs')" 
                    class="tab-button whitespace-nowrap py-4 px-4 sm:px-6 text-sm font-medium border-b-2 transition-colors" 
                    data-tab="bailleurs">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Bailleurs
                    </span>
                </button>
                <button onclick="switchTab('comptes-associes')" 
                    class="tab-button whitespace-nowrap py-4 px-4 sm:px-6 text-sm font-medium border-b-2 transition-colors" 
                    data-tab="comptes-associes">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Comptes Associés
                    </span>
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="p-6">
            <!-- Fournisseurs Tab -->
            <div id="tab-fournisseurs" class="tab-content">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Liste des fournisseurs</h3>
                    <a href="<?php echo e(route('fournisseurs.create')); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer un fournisseur
                    </a>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Gérez vos fournisseurs et leurs informations</p>
                <a href="<?php echo e(route('fournisseurs.index')); ?>" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 text-sm font-medium">
                    Voir la liste complète →
                </a>
            </div>

            <!-- Personnel Tab -->
            <div id="tab-personnel" class="tab-content hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Liste du personnel</h3>
                    <a href="<?php echo e(route('personnel.create')); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer un personnel
                    </a>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Gérez votre personnel et leurs informations</p>
                <a href="<?php echo e(route('personnel.index')); ?>" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 text-sm font-medium">
                    Voir la liste complète →
                </a>
            </div>

            <!-- Administrations Tab -->
            <div id="tab-administrations" class="tab-content hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Liste des administrations</h3>
                    <a href="<?php echo e(route('administrations.create')); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer une administration
                    </a>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Gérez vos administrations et leurs informations</p>
                <a href="<?php echo e(route('administrations.index')); ?>" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 text-sm font-medium">
                    Voir la liste complète →
                </a>
            </div>

            <!-- Partenaires Tab -->
            <div id="tab-partenaires" class="tab-content hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Liste des partenaires</h3>
                    <a href="<?php echo e(route('partenaires.create')); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer un partenaire
                    </a>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Gérez vos partenaires et leurs informations</p>
                <a href="<?php echo e(route('partenaires.index')); ?>" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 text-sm font-medium">
                    Voir la liste complète →
                </a>
            </div>

            <!-- Comptables Tab -->
            <div id="tab-comptables" class="tab-content hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Liste des comptables</h3>
                    <a href="<?php echo e(route('comptables.create')); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer un comptable
                    </a>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Gérez vos comptables et leurs informations</p>
                <a href="<?php echo e(route('comptables.index')); ?>" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 text-sm font-medium">
                    Voir la liste complète →
                </a>
            </div>

            <!-- Bailleurs Tab -->
            <div id="tab-bailleurs" class="tab-content hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Liste des bailleurs</h3>
                    <a href="<?php echo e(route('bailleurs.create')); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer un bailleur
                    </a>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Gérez vos bailleurs et leurs informations</p>
                <a href="<?php echo e(route('bailleurs.index')); ?>" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 text-sm font-medium">
                    Voir la liste complète →
                </a>
            </div>

            <!-- Comptes Associés Tab -->
            <div id="tab-comptes-associes" class="tab-content hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Liste des comptes associés</h3>
                    <a href="<?php echo e(route('comptes-associes.create')); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer un compte associé
                    </a>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Gérez vos comptes associés et leurs informations</p>
                <a href="<?php echo e(route('comptes-associes.index')); ?>" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 text-sm font-medium">
                    Voir la liste complète →
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active state from all buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('border-blue-500', 'text-blue-600', 'dark:text-blue-400');
        button.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400', 'hover:text-gray-700', 'dark:hover:text-gray-300', 'hover:border-gray-300', 'dark:hover:border-gray-600');
    });
    
    // Show selected tab content
    document.getElementById('tab-' + tabName).classList.remove('hidden');
    
    // Add active state to selected button
    const activeButton = document.querySelector('[data-tab="' + tabName + '"]');
    activeButton.classList.add('border-blue-500', 'text-blue-600', 'dark:text-blue-400');
    activeButton.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400', 'hover:text-gray-700', 'dark:hover:text-gray-300', 'hover:border-gray-300', 'dark:hover:border-gray-600');

    // Update URL without reloading
    const url = new URL(window.location);
    url.searchParams.set('tab', tabName);
    window.history.pushState({}, '', url);
}

// Initialize tabs on page load
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get('tab') || '<?php echo e($activeTab ?? "fournisseurs"); ?>';
    switchTab(activeTab);
});
</script>

<style>
.tab-button {
    @apply border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Espacegamers\Documents\abedrhman\resources\views/sections/tiers.blade.php ENDPATH**/ ?>