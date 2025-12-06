

<?php $__env->startSection('title', $page_title . ' - Abedrhman'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6 sm:space-y-8">
    <!-- Page Header -->
    <div class="bg-gradient-to-r 
        <?php if($color === 'emerald'): ?> from-emerald-600 to-teal-700
        <?php elseif($color === 'blue'): ?> from-blue-600 to-indigo-700
        <?php elseif($color === 'amber'): ?> from-amber-500 to-orange-600
        <?php elseif($color === 'purple'): ?> from-purple-600 to-violet-700
        <?php elseif($color === 'rose'): ?> from-rose-600 to-pink-700
        <?php elseif($color === 'cyan'): ?> from-cyan-600 to-sky-700
        <?php else: ?> from-gray-600 to-slate-700
        <?php endif; ?>
        rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold mb-2"><?php echo e($section_name); ?></h2>
                <p class="text-white/80 text-sm sm:text-base"><?php echo e($section_description); ?></p>
            </div>
        </div>
    </div>

    <!-- Coming Soon Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-8 sm:p-12 text-center">
            <!-- Icon -->
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-6
                <?php if($color === 'emerald'): ?> bg-emerald-100 dark:bg-emerald-900/30
                <?php elseif($color === 'blue'): ?> bg-blue-100 dark:bg-blue-900/30
                <?php elseif($color === 'amber'): ?> bg-amber-100 dark:bg-amber-900/30
                <?php elseif($color === 'purple'): ?> bg-purple-100 dark:bg-purple-900/30
                <?php elseif($color === 'rose'): ?> bg-rose-100 dark:bg-rose-900/30
                <?php elseif($color === 'cyan'): ?> bg-cyan-100 dark:bg-cyan-900/30
                <?php else: ?> bg-gray-100 dark:bg-gray-700
                <?php endif; ?>
            ">
                <?php if($icon === 'calculator'): ?>
                <svg class="w-10 h-10 <?php if($color === 'emerald'): ?> text-emerald-600 dark:text-emerald-400 <?php else: ?> text-gray-600 <?php endif; ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <?php elseif($icon === 'chart'): ?>
                <svg class="w-10 h-10 <?php if($color === 'blue'): ?> text-blue-600 dark:text-blue-400 <?php else: ?> text-gray-600 <?php endif; ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <?php elseif($icon === 'mail'): ?>
                <svg class="w-10 h-10 <?php if($color === 'amber'): ?> text-amber-600 dark:text-amber-400 <?php else: ?> text-gray-600 <?php endif; ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <?php elseif($icon === 'calendar'): ?>
                <svg class="w-10 h-10 <?php if($color === 'purple'): ?> text-purple-600 dark:text-purple-400 <?php else: ?> text-gray-600 <?php endif; ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <?php else: ?>
                <svg class="w-10 h-10 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <?php endif; ?>
            </div>

            <!-- Title -->
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                Section en cours de développement
            </h3>

            <!-- Description -->
            <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto mb-6">
                Cette fonctionnalité sera bientôt disponible. Nous travaillons activement pour vous offrir une expérience complète.
            </p>

            <!-- Features Preview -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6 max-w-lg mx-auto">
                <h4 class="font-semibold text-gray-900 dark:text-white mb-4 text-sm uppercase tracking-wide">
                    Fonctionnalités à venir
                </h4>
                <ul class="space-y-3 text-left">
                    <?php if($icon === 'calculator'): ?>
                    <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Suivi des entrées et sorties de caisse
                    </li>
                    <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Prévisions budgétaires
                    </li>
                    <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Alertes de trésorerie
                    </li>
                    <?php elseif($icon === 'chart'): ?>
                    <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Rapports de chiffre d'affaires
                    </li>
                    <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Analyse des dépenses
                    </li>
                    <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Export PDF et Excel
                    </li>
                    <?php elseif($icon === 'mail'): ?>
                    <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Relances automatiques par email
                    </li>
                    <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Suivi des impayés
                    </li>
                    <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Historique des relances
                    </li>
                    <?php elseif($icon === 'calendar'): ?>
                    <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Planification des rendez-vous
                    </li>
                    <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Rappels automatiques
                    </li>
                    <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Historique des rencontres
                    </li>
                    <?php else: ?>
                    <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Fonctionnalité en cours de développement
                    </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Back Button -->
            <div class="mt-8">
                <a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour au tableau de bord
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Espacegamers\Documents\abedrhman\resources\views/sections/placeholder.blade.php ENDPATH**/ ?>