<?php $__env->startSection('title', 'Nouveau service - Abedrhman'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6 sm:space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm">
        <a href="<?php echo e(route('services.index')); ?>" class="text-gray-500 dark:text-gray-400 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">Services</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-900 dark:text-white font-medium">Nouveau service</span>
    </div>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-teal-600 to-cyan-700 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <h2 class="text-xl sm:text-2xl font-bold mb-2">Créer un nouveau service</h2>
        <p class="text-teal-100 text-sm sm:text-base">Sélectionnez un client et remplissez les informations du service</p>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6 sm:p-8">
        <form action="<?php echo e(route('services.store')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            
            <!-- Client Selection Section -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Sélection du client
                </h3>
                
                <div>
                    <label for="client_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Client *</label>
                    <select name="client_id" id="client_id" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                        onchange="showClientInfo(this.value)">
                        <option value="">Sélectionner un client</option>
                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($client->id); ?>" 
                            data-nom="<?php echo e($client->type === 'particulier' ? ($client->nom . ' ' . $client->prenom) : $client->nom_raison_sociale); ?>"
                            data-raison-sociale="<?php echo e($client->type !== 'particulier' ? $client->nom_raison_sociale : ''); ?>"
                            data-gerant="<?php echo e($client->type !== 'particulier' ? ($client->dirigeants->first()->nom ?? 'N/A') : 'N/A'); ?>"
                            data-ville="<?php echo e($client->ville ?? 'N/A'); ?>"
                            data-type="<?php echo e($client->type); ?>"
                            <?php echo e(old('client_id') == $client->id ? 'selected' : ''); ?>>
                            <?php if($client->type === 'particulier'): ?>
                                <?php echo e($client->nom); ?> <?php echo e($client->prenom); ?>

                            <?php else: ?>
                                <?php echo e($client->nom_raison_sociale); ?><?php if($client->sigle): ?> (<?php echo e($client->sigle); ?>)<?php endif; ?>
                            <?php endif; ?>
                            <?php if($client->num_client): ?> - <?php echo e($client->num_client); ?><?php endif; ?>
                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['client_id'];
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

                <!-- Client Info Block -->
                <div id="client-info-block" class="hidden bg-gradient-to-br from-slate-50 to-teal-50 dark:from-gray-700/50 dark:to-teal-900/20 rounded-xl p-4 border border-teal-200 dark:border-teal-800">
                    <div class="flex items-start gap-4">
                        <div class="h-12 w-12 rounded-full bg-teal-100 dark:bg-teal-900/50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nom / Raison sociale</p>
                                <p id="client-nom" class="text-sm font-semibold text-gray-900 dark:text-white mt-1">-</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Gérant</p>
                                <p id="client-gerant" class="text-sm font-semibold text-gray-900 dark:text-white mt-1">-</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Ville</p>
                                <p id="client-ville" class="text-sm font-semibold text-gray-900 dark:text-white mt-1">-</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-gray-200 dark:border-gray-700">

            <!-- Service Details Section -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Détails du service
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Type Service -->
                    <div>
                        <label for="type_service_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type de service *</label>
                        <?php if(isset($selectedTypeServiceId) && $selectedTypeServiceId): ?>
                            
                            <?php $selectedType = $typesServices->firstWhere('id', $selectedTypeServiceId); ?>
                            <input type="hidden" name="type_service_id" value="<?php echo e($selectedTypeServiceId); ?>">
                            <div class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-200 cursor-not-allowed">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <?php echo e($selectedType->nom ?? 'Type sélectionné'); ?>

                                    <?php if($selectedType && $selectedType->prix): ?> - <?php echo e($selectedType->formatted_prix); ?><?php endif; ?>
                                </span>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Le type de service est pré-sélectionné et ne peut pas être modifié.</p>
                        <?php else: ?>
                            
                            <select name="type_service_id" id="type_service_id" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                                <option value="">Sélectionner un type</option>
                                <?php $__currentLoopData = $typesServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($type->id); ?>" 
                                    data-prix="<?php echo e($type->prix ?? 0); ?>"
                                    <?php echo e((old('type_service_id') == $type->id) ? 'selected' : ''); ?>>
                                    <?php echo e($type->nom); ?>

                                    <?php if($type->prix): ?> - <?php echo e($type->formatted_prix); ?><?php endif; ?>
                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        <?php endif; ?>
                        <?php $__errorArgs = ['type_service_id'];
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

                    <!-- Prix -->
                    <div>
                        <label for="prix" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Prix (DH) *</label>
                        <?php if(isset($offersWithPrices) && count($offersWithPrices) > 0): ?>
                            
                            <div class="space-y-2">
                                <select id="offre_tarification_select" 
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                                    onchange="updatePriceFromOffer(this)">
                                    <option value="">-- Sélectionner une offre/tarification --</option>
                                    <?php $defaultPriceSet = false; ?>
                                    <?php $__currentLoopData = $offersWithPrices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($offre['prices']) > 0): ?>
                                            <?php $__currentLoopData = $offre['prices']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $isStandard = strtolower($price['type_name']) === 'standard';
                                                    $isFirst = !$defaultPriceSet && $isStandard;
                                                    if($isFirst) $defaultPriceSet = true;
                                                ?>
                                                <option value="<?php echo e($price['prix']); ?>" <?php echo e($isFirst ? 'selected' : ''); ?>

                                                    data-offre="<?php echo e($offre['nom']); ?>"
                                                    data-type="<?php echo e($price['type_name']); ?>">
                                                    <?php echo e($offre['nom']); ?> - <?php echo e($price['type_name']); ?>: <?php echo e(number_format($price['prix'], 2, ',', ' ')); ?> DH
                                                    <?php if($offre['duree_mois']): ?> (<?php echo e($offre['duree_mois']); ?> mois)<?php endif; ?>
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <?php if(!$defaultPriceSet && count($offersWithPrices) > 0 && count($offersWithPrices[0]['prices'] ?? []) > 0): ?>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var select = document.getElementById('offre_tarification_select');
                                                if (select && select.options.length > 1) {
                                                    select.selectedIndex = 1;
                                                    updatePriceFromOffer(select);
                                                }
                                            });
                                        </script>
                                    <?php endif; ?>
                                </select>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    <svg class="inline w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Prix basé sur la tarification configurée. Vous pouvez le modifier ci-dessous.
                                </p>
                            </div>
                        <?php endif; ?>
                        <input type="number" name="prix" id="prix" 
                            value="<?php echo e(old('prix', isset($offersWithPrices) && count($offersWithPrices) > 0 ? collect($offersWithPrices)->pluck('prices')->flatten(1)->firstWhere('type_name', 'Standard')['prix'] ?? (collect($offersWithPrices)->pluck('prices')->flatten(1)->first()['prix'] ?? 0) : 0)); ?>" 
                            required min="0" step="0.01"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors <?php echo e(isset($offersWithPrices) && count($offersWithPrices) > 0 ? 'mt-2' : ''); ?>"
                            placeholder="0.00">
                        <?php $__errorArgs = ['prix'];
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
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors resize-none"
                        placeholder="Description du service..."><?php echo e(old('description')); ?></textarea>
                    <?php $__errorArgs = ['description'];
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

                <!-- Active -->
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" checked
                        class="w-4 h-4 text-teal-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-teal-500 focus:ring-2">
                    <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Service actif</label>
                </div>
            </div>

            <hr class="border-gray-200 dark:border-gray-700">

            <!-- Sous-Services Section -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Sous-services (optionnel)
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">- Sélectionnez les sous-services à inclure</span>
                </h3>

                <?php if($sousServices->count() > 0): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    <?php $__currentLoopData = $sousServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sousService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="relative flex items-start p-4 rounded-lg border border-gray-200 dark:border-gray-600 hover:border-indigo-300 dark:hover:border-indigo-600 cursor-pointer transition-colors sous-service-item">
                        <input type="checkbox" name="sous_services[]" value="<?php echo e($sousService->id); ?>"
                            class="w-4 h-4 mt-0.5 text-indigo-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-indigo-500 focus:ring-2"
                            data-prix="<?php echo e($sousService->prix); ?>"
                            onchange="updateTotalPreview()">
                        <div class="ml-3 flex-1">
                            <span class="text-sm font-medium text-gray-900 dark:text-white"><?php echo e($sousService->nom); ?></span>
                            <span class="block text-sm text-indigo-600 dark:text-indigo-400 font-semibold"><?php echo e($sousService->formatted_prix); ?></span>
                            <?php if($sousService->description): ?>
                            <span class="block text-xs text-gray-500 dark:text-gray-400 mt-1"><?php echo e($sousService->description); ?></span>
                            <?php endif; ?>
                        </div>
                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Total Preview -->
                <div class="bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-800 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-indigo-800 dark:text-indigo-200">Aperçu du montant total</p>
                            <p class="text-xs text-indigo-600 dark:text-indigo-400">Prix de base + sous-services sélectionnés</p>
                        </div>
                        <div class="text-right">
                            <p id="total-preview" class="text-2xl font-bold text-indigo-700 dark:text-indigo-300">0,00 DH</p>
                            <p class="text-xs text-indigo-600 dark:text-indigo-400">
                                Base: <span id="base-preview">0,00</span> + Sous-services: <span id="sous-services-preview">0,00</span>
                            </p>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 text-center">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Aucun sous-service disponible. Vous pouvez en ajouter depuis les paramètres.</p>
                    <a href="<?php echo e(route('parametres.sous-services')); ?>" class="inline-flex items-center mt-2 text-sm text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Créer des sous-services
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <!-- Info Note -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="text-sm text-blue-700 dark:text-blue-300">
                        <strong>Note:</strong> Le service sera créé avec le statut <span class="font-semibold">"Initialisé"</span>. 
                        Vous pourrez ensuite gérer les paiements et modifier le statut depuis la liste des services.
                    </p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="<?php echo e(route('services.index')); ?>" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Créer le service
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showClientInfo(clientId) {
    const select = document.getElementById('client_id');
    const infoBlock = document.getElementById('client-info-block');
    const selectedOption = select.options[select.selectedIndex];
    
    if (clientId && selectedOption) {
        const nom = selectedOption.dataset.nom || '-';
        const gerant = selectedOption.dataset.gerant || 'N/A';
        const ville = selectedOption.dataset.ville || 'N/A';
        const type = selectedOption.dataset.type;
        
        document.getElementById('client-nom').textContent = nom;
        document.getElementById('client-gerant').textContent = type === 'morale' ? gerant : 'N/A (Particulier)';
        document.getElementById('client-ville').textContent = ville;
        
        infoBlock.classList.remove('hidden');
    } else {
        infoBlock.classList.add('hidden');
    }
}

function updatePriceFromOffer(selectElement) {
    const prixInput = document.getElementById('prix');
    const selectedValue = selectElement.value;
    
    if (selectedValue && prixInput) {
        prixInput.value = parseFloat(selectedValue).toFixed(2);
        updateTotalPreview();
    }
}

function updateTotalPreview() {
    const prixInput = document.getElementById('prix');
    const basePrix = parseFloat(prixInput.value) || 0;
    
    let sousServicesTotal = 0;
    document.querySelectorAll('input[name="sous_services[]"]:checked').forEach(checkbox => {
        sousServicesTotal += parseFloat(checkbox.dataset.prix) || 0;
    });
    
    const total = basePrix + sousServicesTotal;
    
    document.getElementById('base-preview').textContent = formatCurrency(basePrix);
    document.getElementById('sous-services-preview').textContent = formatCurrency(sousServicesTotal);
    document.getElementById('total-preview').textContent = formatCurrency(total) + ' DH';
}

function formatCurrency(value) {
    return value.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
}

// Auto-set price from type service selection
document.getElementById('type_service_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const prix = selectedOption.dataset.prix;
    if (prix && parseFloat(prix) > 0) {
        document.getElementById('prix').value = parseFloat(prix).toFixed(2);
        updateTotalPreview();
    }
});

// Update preview on price change
document.getElementById('prix').addEventListener('input', updateTotalPreview);

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const clientId = document.getElementById('client_id').value;
    if (clientId) {
        showClientInfo(clientId);
    }
    
    // If there's an offer tarification select, set the default price
    const offreTarificationSelect = document.getElementById('offre_tarification_select');
    if (offreTarificationSelect && offreTarificationSelect.value) {
        updatePriceFromOffer(offreTarificationSelect);
    }
    
    // Trigger type service change to set default price (only if no pre-selected type)
    const typeServiceSelect = document.getElementById('type_service_id');
    if (typeServiceSelect && typeServiceSelect.value) {
        const event = new Event('change');
        typeServiceSelect.dispatchEvent(event);
    }
    
    updateTotalPreview();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Espacegamers\Documents\abedrhman\resources\views/sections/services-create.blade.php ENDPATH**/ ?>