

<?php $__env->startSection('title', ($comptable ? 'Modifier' : 'Créer') . ' un comptable - Abedrhman'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="flex items-center gap-3">
        <a href="<?php echo e(route('comptables.index')); ?>" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white">
            <?php echo e($comptable ? 'Modifier' : 'Créer'); ?> un comptable
        </h2>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6">
        <form action="<?php echo e($comptable ? route('comptables.update', $comptable->id) : route('comptables.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php if($comptable): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="raison_sociale" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Raison sociale</label>
                    <input type="text" id="raison_sociale" name="raison_sociale" value="<?php echo e(old('raison_sociale', $comptable->raison_sociale ?? '')); ?>"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="activite" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Activité</label>
                    <input type="text" id="activite" name="activite" value="<?php echo e(old('activite', $comptable->activite ?? '')); ?>"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Responsable Section Card -->
            <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Responsable</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="responsable_nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nom</label>
                        <input type="text" id="responsable_nom" name="responsable_nom" value="<?php echo e(old('responsable_nom', $comptable->responsable_nom ?? '')); ?>"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="responsable_prenom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Prénom</label>
                        <input type="text" id="responsable_prenom" name="responsable_prenom" value="<?php echo e(old('responsable_prenom', $comptable->responsable_prenom ?? '')); ?>"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="fonction" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Fonction</label>
                        <input type="text" id="fonction" name="fonction" value="<?php echo e(old('fonction', $comptable->fonction ?? '')); ?>"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="tel" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Téléphone</label>
                    <input type="text" id="tel" name="tel" value="<?php echo e(old('tel', $comptable->tel ?? '')); ?>"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo e(old('email', $comptable->email ?? '')); ?>"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="ice" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ICE</label>
                    <input type="text" id="ice" name="ice" value="<?php echo e(old('ice', $comptable->ice ?? '')); ?>"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="rib" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">RIB</label>
                    <input type="text" id="rib" name="rib" value="<?php echo e(old('rib', $comptable->rib ?? '')); ?>"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label for="adresse" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Adresse</label>
                    <textarea id="adresse" name="adresse" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500"><?php echo e(old('adresse', $comptable->adresse ?? '')); ?></textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="<?php echo e(route('comptables.index')); ?>" class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    <?php echo e($comptable ? 'Mettre à jour' : 'Créer'); ?>

                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Espacegamers\Documents\abedrhman\resources\views/tiers/comptables/form.blade.php ENDPATH**/ ?>