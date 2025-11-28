

<?php $__env->startSection('title', 'Tarification DOM - Paramètres - Abedrhman'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6 sm:space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm">
        <a href="<?php echo e(route('parametres.index')); ?>" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Paramètres</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-900 dark:text-white font-medium">Grille tarifaire DOM</span>
    </div>

    <!-- Success Message -->
    <?php if(session('success')): ?>
    <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl p-4 flex items-start gap-3">
        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-sm text-emerald-700 dark:text-emerald-300"><?php echo e(session('success')); ?></span>
    </div>
    <?php endif; ?>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <h2 class="text-xl sm:text-2xl font-bold mb-2">Grille tarifaire DOM</h2>
        <p class="text-blue-100 text-sm sm:text-base">Définissez les prix pour chaque combinaison offre / type de tarification.</p>
    </div>

    <?php if($offresDom->count() > 0 && $typesTarification->count() > 0): ?>
    <form action="<?php echo e(route('parametres.tarifications-dom.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="p-4 sm:p-6 border-b border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Configuration des tarifs</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Tous les prix sont en DH (Dirhams)</p>
                </div>
                <button type="submit" 
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center gap-2 shadow-lg shadow-blue-600/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Sauvegarder tous les tarifs
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900/50">
                        <tr>
                            <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider bg-gray-100 dark:bg-gray-800 sticky left-0">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    Offre
                                </div>
                            </th>
                            <?php $__currentLoopData = $typesTarification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th class="px-4 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider min-w-[140px]">
                                <div class="flex flex-col items-center gap-1">
                                    <span><?php echo e($type->nom); ?></span>
                                    <span class="text-[10px] font-normal text-gray-400 dark:text-gray-500 normal-case">(<?php echo e($type->code); ?>)</span>
                                </div>
                            </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <?php $__currentLoopData = $offresDom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-4 py-4 whitespace-nowrap bg-gray-50 dark:bg-gray-800 sticky left-0 border-r border-gray-200 dark:border-gray-700">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                                        <span class="text-sm font-bold text-emerald-600 dark:text-emerald-400"><?php echo e($offre->duree_mois); ?>m</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white"><?php echo e($offre->nom); ?></div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400"><?php echo e($offre->duree_mois); ?> mois</div>
                                    </div>
                                </div>
                            </td>
                            <?php $__currentLoopData = $typesTarification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="relative">
                                    <input 
                                        type="number" 
                                        name="tarifications[<?php echo e($offre->id); ?>][<?php echo e($type->id); ?>]" 
                                        value="<?php echo e($tarificationsMatrix[$offre->id][$type->id] ?? ''); ?>"
                                        placeholder="0"
                                        step="0.01"
                                        min="0"
                                        class="w-full px-3 py-2 pr-10 text-sm text-center rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                    >
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-medium text-gray-400 dark:text-gray-500">DH</span>
                                </div>
                            </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 sm:p-6 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 flex justify-end">
                <button type="submit" 
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center gap-2 shadow-lg shadow-blue-600/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Sauvegarder tous les tarifs
                </button>
            </div>
        </div>
    </form>
    <?php else: ?>
    <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-8 text-center">
        <svg class="w-16 h-16 mx-auto text-amber-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        <h3 class="text-lg font-semibold text-amber-800 dark:text-amber-200 mb-2">Configuration requise</h3>
        <p class="text-sm text-amber-700 dark:text-amber-300 mb-6">Pour configurer la grille tarifaire, vous devez d'abord créer des offres DOM et des types de tarification.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <?php if($offresDom->count() == 0): ?>
            <a href="<?php echo e(route('parametres.offres-dom')); ?>" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Créer des offres DOM
            </a>
            <?php endif; ?>
            <?php if($typesTarification->count() == 0): ?>
            <a href="<?php echo e(route('parametres.types-tarification')); ?>" class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Créer des types de tarification
            </a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Espacegamers\Documents\abedrhman\resources\views/parametres/tarifications-dom.blade.php ENDPATH**/ ?>