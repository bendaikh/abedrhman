

<?php $__env->startSection('title', 'Étapes création - Abedrhman'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $creationSteps = [
        'Qualification du besoin',
        'Étude & cadrage',
        'Conception et contractualisation',
        'Déploiement et accompagnement'
    ];
?>
<div class="space-y-6 sm:space-y-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow p-4 sm:p-6 border border-gray-100 dark:border-gray-700">
        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-3 sm:mb-4">Étapes service création</h3>
        <ol class="space-y-3 sm:space-y-4">
            <?php $__currentLoopData = $creationSteps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="flex items-start">
                    <span class="flex-shrink-0 h-7 w-7 sm:h-8 sm:w-8 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold mr-3 sm:mr-4 text-sm sm:text-base">
                        <?php echo e($index + 1); ?>

                    </span>
                    <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-200 pt-1"><?php echo e($step); ?></p>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Espacegamers\Documents\abedrhman\resources\views/sections/etapes-creation.blade.php ENDPATH**/ ?>