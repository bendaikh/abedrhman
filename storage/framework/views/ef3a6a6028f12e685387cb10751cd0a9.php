

<?php $__env->startSection('title', 'Tarification - Abedrhman'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $unitPricing = ['Standard', 'Promotionnelle', 'Préférentielle'];
    $packPricing = ['Pack 1', 'Pack 2', 'Pack 3'];
?>
<div class="space-y-6 sm:space-y-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow p-4 sm:p-6 border border-gray-100 dark:border-gray-700">
            <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-2">Tarification unitaire</h3>
            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-3 sm:mb-4">
                Facturation par service selon le niveau d'accompagnement recherché.
            </p>
            <ul class="space-y-2 sm:space-y-3">
                <?php $__currentLoopData = $unitPricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex items-start">
                        <span class="mt-1 h-2 w-2 rounded-full bg-emerald-500 mr-2 sm:mr-3 flex-shrink-0"></span>
                        <div>
                            <p class="text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-200"><?php echo e($price); ?></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Conditions adaptées à la situation client.</p>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow p-4 sm:p-6 border border-gray-100 dark:border-gray-700">
            <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-2">Tarification pack</h3>
            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-3 sm:mb-4">
                Combinaisons de services prêtes à l'emploi pour accélérer l'onboarding.
            </p>
            <ul class="space-y-2 sm:space-y-3">
                <?php $__currentLoopData = $packPricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pack): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex items-start">
                        <span class="mt-1 h-2 w-2 rounded-full bg-purple-500 mr-2 sm:mr-3 flex-shrink-0"></span>
                        <div>
                            <p class="text-xs sm:text-sm font-medium text-gray-800 dark:text-gray-200"><?php echo e($pack); ?></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Inclusions et remises définies selon le pack.</p>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Espacegamers\Documents\abedrhman\resources\views/sections/tarification.blade.php ENDPATH**/ ?>