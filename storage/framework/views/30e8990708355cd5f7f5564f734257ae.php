

<?php $__env->startSection('title', 'Étapes domiciliation - Abedrhman'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $domiciliationSteps = [
        ['index' => 1, 'title' => 'Demande', 'text' => 'Collecte de la demande et des pièces annexes'],
        ['index' => 2, 'title' => 'Signature contrat', 'text' => 'Validation des clauses et paraphe du contrat'],
        ['index' => 3, 'title' => 'Signat', 'text' => 'Apposition des signatures complémentaires (clients / partenaires)'],
        ['index' => 4, 'title' => 'Validation', 'text' => 'Contrôle final et mise à disposition du service']
    ];
?>
<div class="space-y-6 sm:space-y-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow p-4 sm:p-6 border border-gray-100 dark:border-gray-700">
        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-3 sm:mb-4">Étapes service domiciliation</h3>
        <ol class="space-y-3 sm:space-y-4">
            <?php $__currentLoopData = $domiciliationSteps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="flex items-start">
                    <span class="flex-shrink-0 h-7 w-7 sm:h-8 sm:w-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold mr-3 sm:mr-4 text-sm sm:text-base">
                        <?php echo e($step['index']); ?>

                    </span>
                    <div class="pt-1">
                        <p class="text-xs sm:text-sm font-medium text-gray-900 dark:text-gray-100"><?php echo e($step['title']); ?></p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5"><?php echo e($step['text']); ?></p>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Espacegamers\Documents\abedrhman\resources\views/sections/etapes-domiciliation.blade.php ENDPATH**/ ?>