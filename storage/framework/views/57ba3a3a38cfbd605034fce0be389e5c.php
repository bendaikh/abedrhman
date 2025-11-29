

<?php $__env->startSection('title', 'Détails du personnel - Abedrhman'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="<?php echo e(route('personnel.index')); ?>" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white">Détails du personnel</h2>
        </div>
        <div class="flex gap-2">
            <a href="<?php echo e(route('personnel.edit', $personnel->id)); ?>" 
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                Modifier
            </a>
            <form action="<?php echo e(route('personnel.destroy', $personnel->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr ?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">
                    Supprimer
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-6">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nom</dt>
                    <dd class="text-base text-gray-900 dark:text-white"><?php echo e($personnel->nom ?? 'N/A'); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Prénom</dt>
                    <dd class="text-base text-gray-900 dark:text-white"><?php echo e($personnel->prenom ?? 'N/A'); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">CIN</dt>
                    <dd class="text-base text-gray-900 dark:text-white"><?php echo e($personnel->cin ?? 'N/A'); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Date de naissance</dt>
                    <dd class="text-base text-gray-900 dark:text-white"><?php echo e($personnel->date_naissance ? $personnel->date_naissance->format('d/m/Y') : 'N/A'); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Téléphone</dt>
                    <dd class="text-base text-gray-900 dark:text-white"><?php echo e($personnel->tel ?? 'N/A'); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email</dt>
                    <dd class="text-base text-gray-900 dark:text-white"><?php echo e($personnel->email ?? 'N/A'); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Poste</dt>
                    <dd class="text-base text-gray-900 dark:text-white"><?php echo e($personnel->poste ?? 'N/A'); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tâche</dt>
                    <dd class="text-base text-gray-900 dark:text-white"><?php echo e($personnel->tache ?? 'N/A'); ?></dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Adresse</dt>
                    <dd class="text-base text-gray-900 dark:text-white"><?php echo e($personnel->adresse ?? 'N/A'); ?></dd>
                </div>
            </dl>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Espacegamers\Documents\abedrhman\resources\views/tiers/personnel/show.blade.php ENDPATH**/ ?>