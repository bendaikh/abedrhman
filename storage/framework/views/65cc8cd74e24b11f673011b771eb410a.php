<?php $__env->startSection('title', 'Paramètres - Abedrhman'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6 sm:space-y-8">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <h2 class="text-xl sm:text-2xl font-bold mb-2">Paramètres</h2>
        <p class="text-blue-100 text-sm sm:text-base">Configurez les offres de domiciliation, création d'entreprise et les types de tarification.</p>
    </div>

    <!-- DOM Section -->
    <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
            <div class="h-8 w-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            Domiciliation (DOM)
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            <!-- Offres DOM Card -->
            <a href="<?php echo e(route('parametres.offres-dom')); ?>" class="group bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all duration-200 hover:border-emerald-300 dark:hover:border-emerald-600">
                <div class="flex items-center justify-between mb-4">
                    <div class="h-12 w-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center group-hover:bg-emerald-200 dark:group-hover:bg-emerald-900/50 transition-colors">
                        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <span class="bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-xs font-semibold px-3 py-1 rounded-full">
                        <?php echo e($offresDom->count()); ?> offres
                    </span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Offres DOM</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Gérez les différentes offres de domiciliation (6 mois, 1 an, 2 ans...)</p>
            </a>

            <!-- Tarification DOM Grid Card -->
            <a href="<?php echo e(route('parametres.tarifications-dom')); ?>" class="group bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all duration-200 hover:border-blue-300 dark:hover:border-blue-600">
                <div class="flex items-center justify-between mb-4">
                    <div class="h-12 w-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center group-hover:bg-blue-200 dark:group-hover:bg-blue-900/50 transition-colors">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-semibold px-3 py-1 rounded-full">
                        <?php echo e($tarificationsDom->count()); ?> prix
                    </span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Grille tarifaire DOM</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Configurez les prix DOM pour chaque combinaison offre/tarification</p>
            </a>
        </div>
    </div>

    <!-- CREA Section -->
    <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
            <div class="h-8 w-8 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            Création d'entreprise (CREA)
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            <!-- Offres CREA Card -->
            <a href="<?php echo e(route('parametres.offres-crea')); ?>" class="group bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all duration-200 hover:border-amber-300 dark:hover:border-amber-600">
                <div class="flex items-center justify-between mb-4">
                    <div class="h-12 w-12 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center group-hover:bg-amber-200 dark:group-hover:bg-amber-900/50 transition-colors">
                        <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-xs font-semibold px-3 py-1 rounded-full">
                        <?php echo e($offresCrea->count()); ?> offres
                    </span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Offres CREA</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Gérez les différentes offres de création d'entreprise</p>
            </a>

            <!-- Tarification CREA Grid Card -->
            <a href="<?php echo e(route('parametres.tarifications-crea')); ?>" class="group bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all duration-200 hover:border-orange-300 dark:hover:border-orange-600">
                <div class="flex items-center justify-between mb-4">
                    <div class="h-12 w-12 rounded-xl bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center group-hover:bg-orange-200 dark:group-hover:bg-orange-900/50 transition-colors">
                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 text-xs font-semibold px-3 py-1 rounded-full">
                        <?php echo e($tarificationsCrea->count()); ?> prix
                    </span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Grille tarifaire CREA</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Configurez les prix CREA pour chaque combinaison offre/tarification</p>
            </a>
        </div>
    </div>

    <!-- Types Tarification Card (Common for both) -->
    <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
            <div class="h-8 w-8 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>
            Configuration commune
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            <a href="<?php echo e(route('parametres.types-tarification')); ?>" class="group bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-all duration-200 hover:border-purple-300 dark:hover:border-purple-600">
                <div class="flex items-center justify-between mb-4">
                    <div class="h-12 w-12 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center group-hover:bg-purple-200 dark:group-hover:bg-purple-900/50 transition-colors">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <span class="bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 text-xs font-semibold px-3 py-1 rounded-full">
                        <?php echo e($typesTarification->count()); ?> types
                    </span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Types de tarification</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Définissez les types de tarifs (Standard, Promotionnelle, Préférentielle...)</p>
            </a>
        </div>
    </div>

    <!-- DOM Tarification Overview -->
    <?php if($offresDom->count() > 0 && $typesTarification->count() > 0): ?>
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-100 dark:border-gray-700 bg-emerald-50 dark:bg-emerald-900/20">
            <div class="flex items-center gap-2">
                <div class="h-8 w-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Aperçu - Grille tarifaire DOM</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Récapitulatif des tarifs de domiciliation</p>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Offre</th>
                        <?php $__currentLoopData = $typesTarification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider"><?php echo e($type->nom); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <?php $__currentLoopData = $offresDom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white"><?php echo e($offre->nom); ?></div>
                            <div class="text-xs text-gray-500 dark:text-gray-400"><?php echo e($offre->duree_mois); ?> mois</div>
                        </td>
                        <?php $__currentLoopData = $typesTarification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $tarif = $tarificationsDom->where('offre_dom_id', $offre->id)->where('type_tarification_id', $type->id)->first();
                        ?>
                        <td class="px-4 py-3 whitespace-nowrap text-center">
                            <?php if($tarif): ?>
                            <span class="text-sm font-medium text-gray-900 dark:text-white"><?php echo e(number_format($tarif->prix, 0, ',', ' ')); ?> DH</span>
                            <?php else: ?>
                            <span class="text-sm text-gray-400 dark:text-gray-500">—</span>
                            <?php endif; ?>
                        </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <!-- CREA Tarification Overview -->
    <?php if($offresCrea->count() > 0 && $typesTarification->count() > 0): ?>
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-100 dark:border-gray-700 bg-amber-50 dark:bg-amber-900/20">
            <div class="flex items-center gap-2">
                <div class="h-8 w-8 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Aperçu - Grille tarifaire CREA</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Récapitulatif des tarifs de création d'entreprise</p>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Offre</th>
                        <?php $__currentLoopData = $typesTarification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider"><?php echo e($type->nom); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <?php $__currentLoopData = $offresCrea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white"><?php echo e($offre->nom); ?></div>
                            <?php if($offre->description): ?>
                            <div class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-[200px]"><?php echo e($offre->description); ?></div>
                            <?php endif; ?>
                        </td>
                        <?php $__currentLoopData = $typesTarification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $tarif = $tarificationsCrea->where('offre_crea_id', $offre->id)->where('type_tarification_id', $type->id)->first();
                        ?>
                        <td class="px-4 py-3 whitespace-nowrap text-center">
                            <?php if($tarif): ?>
                            <span class="text-sm font-medium text-gray-900 dark:text-white"><?php echo e(number_format($tarif->prix, 0, ',', ' ')); ?> DH</span>
                            <?php else: ?>
                            <span class="text-sm text-gray-400 dark:text-gray-500">—</span>
                            <?php endif; ?>
                        </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <!-- Configuration Required Warning -->
    <?php if(($offresDom->count() == 0 && $offresCrea->count() == 0) || $typesTarification->count() == 0): ?>
    <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-6 text-center">
        <svg class="w-12 h-12 mx-auto text-amber-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        <h3 class="text-lg font-semibold text-amber-800 dark:text-amber-200 mb-2">Configuration requise</h3>
        <p class="text-sm text-amber-700 dark:text-amber-300">Commencez par créer des offres (DOM ou CREA) et des types de tarification pour pouvoir configurer les grilles tarifaires.</p>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Espacegamers\Documents\abedrhman\resources\views/parametres/index.blade.php ENDPATH**/ ?>