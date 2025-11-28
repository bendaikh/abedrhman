

<?php $__env->startSection('title', 'Offres DOM - Paramètres - Abedrhman'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6 sm:space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm">
        <a href="<?php echo e(route('parametres.index')); ?>" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Paramètres</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-900 dark:text-white font-medium">Offres DOM</span>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Add New Offer Form -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Nouvelle offre
                </h3>
                <form action="<?php echo e(route('parametres.offres-dom.store')); ?>" method="POST" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom de l'offre</label>
                        <input type="text" name="nom" id="nom" required placeholder="Ex: DOM 6 MOIS" 
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                        <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label for="duree_mois" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Durée (en mois)</label>
                        <input type="number" name="duree_mois" id="duree_mois" required min="1" placeholder="Ex: 6" 
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                        <?php $__errorArgs = ['duree_mois'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="is_active" checked 
                            class="w-4 h-4 text-emerald-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-emerald-500 focus:ring-2">
                        <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Offre active</label>
                    </div>
                    <button type="submit" 
                        class="w-full px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Ajouter l'offre
                    </button>
                </form>
            </div>
        </div>

        <!-- Existing Offers List -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-4 sm:p-6 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Offres existantes</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1"><?php echo e($offresDom->count()); ?> offre(s) configurée(s)</p>
                </div>
                
                <?php if($offresDom->count() > 0): ?>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    <?php $__currentLoopData = $offresDom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-4 sm:p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <form action="<?php echo e(route('parametres.offres-dom.update', $offre)); ?>" method="POST" class="space-y-4">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                                <div class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nom</label>
                                        <input type="text" name="nom" value="<?php echo e($offre->nom); ?>" required 
                                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Durée (mois)</label>
                                        <input type="number" name="duree_mois" value="<?php echo e($offre->duree_mois); ?>" required min="1" 
                                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    </div>
                                    <div class="flex items-end gap-4">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" name="is_active" id="is_active_<?php echo e($offre->id); ?>" <?php echo e($offre->is_active ? 'checked' : ''); ?>

                                                class="w-4 h-4 text-blue-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                            <label for="is_active_<?php echo e($offre->id); ?>" class="text-sm text-gray-700 dark:text-gray-300">Active</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                        Sauvegarder
                                    </button>
                                </div>
                            </div>
                        </form>
                        <form action="<?php echo e(route('parametres.offres-dom.destroy', $offre)); ?>" method="POST" class="mt-2 flex justify-end" 
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="px-3 py-1.5 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Supprimer
                            </button>
                        </form>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <div class="p-8 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Aucune offre</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Utilisez le formulaire ci-dessus pour créer votre première offre DOM.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Espacegamers\Documents\abedrhman\resources\views/parametres/offres-dom.blade.php ENDPATH**/ ?>