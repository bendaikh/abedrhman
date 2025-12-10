

<?php $__env->startSection('title', 'Les charges - Abedrhman'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6 sm:space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm">
        <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Tableau de bord</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-900 dark:text-white font-medium">Les charges</span>
    </div>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-red-600 to-rose-700 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold mb-2">Les charges</h2>
                <p class="text-red-100 text-sm sm:text-base">Gérez les charges et dépenses de l'entreprise.</p>
            </div>
        </div>
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
        <!-- Add Charge Form -->
        <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Nouvelle charge
            </h3>
            
            <form action="<?php echo e(route('charges.store')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                
                <!-- Type de charge -->
                <div>
                    <label for="type_charge_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type de charge *</label>
                    <select name="type_charge_id" id="type_charge_id" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                        <option value="">Sélectionner un type de charge</option>
                        <?php $__currentLoopData = $typesCharge; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeCharge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($typeCharge->id); ?>" <?php echo e(old('type_charge_id') == $typeCharge->id ? 'selected' : ''); ?>>
                            <?php echo e($typeCharge->nom); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['type_charge_id'];
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

                <!-- Designation -->
                <div>
                    <label for="designation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Désignation</label>
                    <input type="text" name="designation" id="designation" value="<?php echo e(old('designation')); ?>"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                        placeholder="Description de la charge">
                    <?php $__errorArgs = ['designation'];
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

                <!-- Montant -->
                <div>
                    <label for="montant" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Montant (DH) *</label>
                    <input type="number" name="montant" id="montant" value="<?php echo e(old('montant')); ?>" required min="0.01" step="0.01"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                        placeholder="0.00">
                    <?php $__errorArgs = ['montant'];
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

                <!-- N° Reçu de paiement -->
                <div>
                    <label for="numero_recu_paiement" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">N° Reçu de paiement</label>
                    <input type="text" name="numero_recu_paiement" id="numero_recu_paiement" value="<?php echo e(old('numero_recu_paiement')); ?>"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                        placeholder="N° du reçu">
                    <?php $__errorArgs = ['numero_recu_paiement'];
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

                <!-- Date de charge -->
                <div>
                    <label for="date_charge" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date de charge *</label>
                    <input type="date" name="date_charge" id="date_charge" value="<?php echo e(old('date_charge', date('Y-m-d'))); ?>" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                    <?php $__errorArgs = ['date_charge'];
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

                <!-- Observation -->
                <div>
                    <label for="observation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Observation</label>
                    <textarea name="observation" id="observation" rows="3"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors resize-none"
                        placeholder="Observations..."><?php echo e(old('observation')); ?></textarea>
                    <?php $__errorArgs = ['observation'];
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

                <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Enregistrer la charge
                </button>
            </form>
        </div>

        <!-- Charges List -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="p-4 sm:p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                <div class="flex items-center gap-2">
                    <div class="h-10 w-10 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Liste des charges</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400"><?php echo e($charges->count()); ?> charge(s) enregistrée(s)</p>
                    </div>
                </div>
            </div>

            <?php if($charges->count() > 0): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900/50">
                        <tr>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Date</th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Type de charge</th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Désignation</th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">N° Reçu</th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Montant</th>
                            <th class="px-3 py-3 text-right text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <?php $__currentLoopData = $charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                <?php echo e($charge->date_charge->format('d/m/Y')); ?>

                            </td>
                            <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                <?php echo e($charge->typeCharge->nom); ?>

                            </td>
                            <td class="px-3 py-3 text-sm text-gray-600 dark:text-gray-300 max-w-[200px] truncate">
                                <?php echo e($charge->designation ?? '-'); ?>

                            </td>
                            <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                <?php echo e($charge->numero_recu_paiement ?? '-'); ?>

                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <span class="text-sm font-semibold text-red-600 dark:text-red-400"><?php echo e($charge->formatted_montant); ?></span>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap text-right text-sm font-medium">
                                <form action="<?php echo e(route('charges.destroy', $charge)); ?>" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette charge ?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="p-2 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors" title="Supprimer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php if($charge->observation): ?>
                        <tr class="bg-gray-50/50 dark:bg-gray-900/20">
                            <td colspan="6" class="px-3 py-2 text-xs text-gray-500 dark:text-gray-400 italic">
                                <span class="font-medium">Observation:</span> <?php echo e($charge->observation); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot class="bg-gray-50 dark:bg-gray-900/50">
                        <tr>
                            <td colspan="4" class="px-3 py-3 text-sm font-semibold text-gray-900 dark:text-white text-right">Total:</td>
                            <td class="px-3 py-3 whitespace-nowrap" colspan="2">
                                <span class="text-sm font-bold text-red-600 dark:text-red-400">
                                    <?php echo e(number_format($charges->sum('montant'), 2, ',', ' ')); ?> DH
                                </span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php else: ?>
            <div class="p-8 text-center">
                <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Aucune charge</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400">Aucune charge n'a été enregistrée. Utilisez le formulaire ci-dessus pour en ajouter une.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Espacegamers\Documents\abedrhman\resources\views/sections/charges.blade.php ENDPATH**/ ?>