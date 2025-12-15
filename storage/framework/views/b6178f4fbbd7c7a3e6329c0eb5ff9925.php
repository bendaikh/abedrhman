<?php $__env->startSection('title', 'Réglages de l\'entreprise - Paramètres - Abedrhman'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6 sm:space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm">
        <a href="<?php echo e(route('parametres.index')); ?>" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Paramètres</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-900 dark:text-white font-medium">Réglages de l'entreprise</span>
    </div>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-700 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <h2 class="text-xl sm:text-2xl font-bold mb-2">Réglages de l'entreprise</h2>
        <p class="text-indigo-100 text-sm sm:text-base">Configurez les informations générales de votre entreprise, dirigeants et associés.</p>
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

    <!-- Tab Navigation -->
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="flex -mb-px" aria-label="Tabs">
                <button type="button" onclick="switchTab('general')" id="tab-general"
                    class="tab-btn w-1/3 py-4 px-4 text-center border-b-2 font-medium text-sm transition-colors
                    border-indigo-500 text-indigo-600 dark:text-indigo-400 bg-indigo-50/50 dark:bg-indigo-900/20">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="hidden sm:inline">Informations générales</span>
                        <span class="sm:hidden">Général</span>
                    </div>
                </button>
                <button type="button" onclick="switchTab('dirigeants')" id="tab-dirigeants"
                    class="tab-btn w-1/3 py-4 px-4 text-center border-b-2 font-medium text-sm transition-colors
                    border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Dirigeants</span>
                        <span class="bg-teal-100 dark:bg-teal-900/50 text-teal-700 dark:text-teal-300 text-xs font-semibold px-2 py-0.5 rounded-full"><?php echo e($settings->dirigeants->count()); ?></span>
                    </div>
                </button>
                <button type="button" onclick="switchTab('associes')" id="tab-associes"
                    class="tab-btn w-1/3 py-4 px-4 text-center border-b-2 font-medium text-sm transition-colors
                    border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
                        </svg>
                        <span>Associés</span>
                        <span class="bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-300 text-xs font-semibold px-2 py-0.5 rounded-full"><?php echo e($settings->associes->count()); ?></span>
                    </div>
                </button>
            </nav>
        </div>

        <!-- Informations générales Tab Content -->
        <div id="content-general" class="tab-content">
            <form action="<?php echo e(route('parametres.reglages-entreprise.update')); ?>" method="POST" class="p-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <!-- Identity Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <div class="h-8 w-8 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                            <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        Identité de l'entreprise
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Raison sociale</label>
                            <input type="text" name="raison_sociale" value="<?php echo e(old('raison_sociale', $settings->raison_sociale)); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="Nom de l'entreprise">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sigle</label>
                            <input type="text" name="sigle" value="<?php echo e(old('sigle', $settings->sigle)); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="Ex: SARL">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Forme juridique</label>
                            <select name="forme_juridique" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option value="">Sélectionner</option>
                                <option value="SARL" <?php echo e(old('forme_juridique', $settings->forme_juridique) === 'SARL' ? 'selected' : ''); ?>>SARL</option>
                                <option value="SARL AU" <?php echo e(old('forme_juridique', $settings->forme_juridique) === 'SARL AU' ? 'selected' : ''); ?>>SARL AU</option>
                                <option value="SA" <?php echo e(old('forme_juridique', $settings->forme_juridique) === 'SA' ? 'selected' : ''); ?>>SA</option>
                                <option value="SNC" <?php echo e(old('forme_juridique', $settings->forme_juridique) === 'SNC' ? 'selected' : ''); ?>>SNC</option>
                                <option value="SCS" <?php echo e(old('forme_juridique', $settings->forme_juridique) === 'SCS' ? 'selected' : ''); ?>>SCS</option>
                                <option value="SAS" <?php echo e(old('forme_juridique', $settings->forme_juridique) === 'SAS' ? 'selected' : ''); ?>>SAS</option>
                                <option value="Auto-entrepreneur" <?php echo e(old('forme_juridique', $settings->forme_juridique) === 'Auto-entrepreneur' ? 'selected' : ''); ?>>Auto-entrepreneur</option>
                                <option value="Personne physique" <?php echo e(old('forme_juridique', $settings->forme_juridique) === 'Personne physique' ? 'selected' : ''); ?>>Personne physique</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Capital social</label>
                            <input type="text" name="capital_social" value="<?php echo e(old('capital_social', $settings->capital_social)); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="Ex: 100 000 DH">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date de création</label>
                            <input type="date" name="date_creation" value="<?php echo e(old('date_creation', $settings->date_creation ? $settings->date_creation->format('Y-m-d') : '')); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        </div>
                    </div>
                </div>

                <!-- Legal References Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <div class="h-8 w-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        Références légales
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ICE</label>
                            <input type="text" name="ice" value="<?php echo e(old('ice', $settings->ice)); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="Identifiant Commun de l'Entreprise">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Identifiant fiscal</label>
                            <input type="text" name="id_fiscale" value="<?php echo e(old('id_fiscale', $settings->id_fiscale)); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="IF">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Patente</label>
                            <input type="text" name="patente" value="<?php echo e(old('patente', $settings->patente)); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="Numéro de patente">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">RC (Registre de Commerce)</label>
                            <input type="text" name="rc" value="<?php echo e(old('rc', $settings->rc)); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="Numéro RC">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">CNSS</label>
                            <input type="text" name="cnss" value="<?php echo e(old('cnss', $settings->cnss)); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="Numéro CNSS">
                        </div>
                    </div>
                </div>

                <!-- Address Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <div class="h-8 w-8 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        Adresse
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Siège social</label>
                            <textarea name="siege_social" rows="3"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none"
                                placeholder="Adresse complète"><?php echo e(old('siege_social', $settings->siege_social)); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ville</label>
                            <input type="text" name="ville" value="<?php echo e(old('ville', $settings->ville)); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="Ville">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pays</label>
                            <input type="text" name="pays" value="<?php echo e(old('pays', $settings->pays ?? 'Maroc')); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="Pays">
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <div class="h-8 w-8 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        Contact
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Téléphone 1</label>
                            <input type="text" name="tel_1" value="<?php echo e(old('tel_1', $settings->tel_1)); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="+212 6XX XXX XXX">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Téléphone 2</label>
                            <input type="text" name="tel_2" value="<?php echo e(old('tel_2', $settings->tel_2)); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="+212 6XX XXX XXX">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fixe</label>
                            <input type="text" name="fixe" value="<?php echo e(old('fixe', $settings->fixe)); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="+212 5XX XXX XXX">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" name="email" value="<?php echo e(old('email', $settings->email)); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="contact@entreprise.ma">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Site web</label>
                            <input type="text" name="site_web" value="<?php echo e(old('site_web', $settings->site_web)); ?>" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="www.entreprise.ma">
                        </div>
                    </div>
                </div>

                <!-- Activity Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <div class="h-8 w-8 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        Activité
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Secteur d'activité</label>
                            <select name="secteur_activite" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option value="">Sélectionner</option>
                                <option value="COMMERCE" <?php echo e(old('secteur_activite', $settings->secteur_activite) === 'COMMERCE' ? 'selected' : ''); ?>>COMMERCE</option>
                                <option value="SERVICES" <?php echo e(old('secteur_activite', $settings->secteur_activite) === 'SERVICES' ? 'selected' : ''); ?>>SERVICES</option>
                                <option value="INDUSTRIE" <?php echo e(old('secteur_activite', $settings->secteur_activite) === 'INDUSTRIE' ? 'selected' : ''); ?>>INDUSTRIE</option>
                                <option value="INFORMATIQUE" <?php echo e(old('secteur_activite', $settings->secteur_activite) === 'INFORMATIQUE' ? 'selected' : ''); ?>>INFORMATIQUE</option>
                                <option value="CONSEIL" <?php echo e(old('secteur_activite', $settings->secteur_activite) === 'CONSEIL' ? 'selected' : ''); ?>>CONSEIL</option>
                                <option value="IMMOBILIER" <?php echo e(old('secteur_activite', $settings->secteur_activite) === 'IMMOBILIER' ? 'selected' : ''); ?>>IMMOBILIER</option>
                                <option value="TRANSPORT" <?php echo e(old('secteur_activite', $settings->secteur_activite) === 'TRANSPORT' ? 'selected' : ''); ?>>TRANSPORT</option>
                                <option value="AUTRE" <?php echo e(old('secteur_activite', $settings->secteur_activite) === 'AUTRE' ? 'selected' : ''); ?>>AUTRE</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Activité principale</label>
                            <textarea name="activite_principale" rows="3"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none"
                                placeholder="Description de l'activité principale"><?php echo e(old('activite_principale', $settings->activite_principale)); ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>

        <!-- Dirigeants Tab Content -->
        <div id="content-dirigeants" class="tab-content hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Add New Dirigeant Form -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Nouveau dirigeant
                            </h3>
                            <form action="<?php echo e(route('parametres.dirigeants.store')); ?>" method="POST" class="space-y-4">
                                <?php echo csrf_field(); ?>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom *</label>
                                        <input type="text" name="nom" required 
                                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Prénom</label>
                                        <input type="text" name="prenom" 
                                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fonction</label>
                                    <input type="text" name="fonction" placeholder="Ex: Gérant, Directeur..."
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">CIN</label>
                                    <input type="text" name="cin" 
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Téléphone</label>
                                    <input type="text" name="telephone" 
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                    <input type="email" name="email" 
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" name="is_representant_legal" id="is_representant_legal"
                                        class="w-4 h-4 text-teal-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-teal-500 focus:ring-2">
                                    <label for="is_representant_legal" class="text-sm font-medium text-gray-700 dark:text-gray-300">Représentant légal</label>
                                </div>
                                <button type="submit" class="w-full px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Ajouter le dirigeant
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Dirigeants List -->
                    <div class="lg:col-span-2">
                        <?php if($settings->dirigeants->count() > 0): ?>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $settings->dirigeants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dirigeant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 sm:p-6">
                                <form action="<?php echo e(route('parametres.dirigeants.update', $dirigeant)); ?>" method="POST" class="space-y-4">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nom</label>
                                            <input type="text" name="nom" value="<?php echo e($dirigeant->nom); ?>" required 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Prénom</label>
                                            <input type="text" name="prenom" value="<?php echo e($dirigeant->prenom); ?>" 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Fonction</label>
                                            <input type="text" name="fonction" value="<?php echo e($dirigeant->fonction); ?>" 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">CIN</label>
                                            <input type="text" name="cin" value="<?php echo e($dirigeant->cin); ?>" 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Téléphone</label>
                                            <input type="text" name="telephone" value="<?php echo e($dirigeant->telephone); ?>" 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Email</label>
                                            <input type="email" name="email" value="<?php echo e($dirigeant->email); ?>" 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between flex-wrap gap-2">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" name="is_representant_legal" id="is_representant_legal_<?php echo e($dirigeant->id); ?>" <?php echo e($dirigeant->is_representant_legal ? 'checked' : ''); ?>

                                                class="w-4 h-4 text-teal-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-teal-500 focus:ring-2">
                                            <label for="is_representant_legal_<?php echo e($dirigeant->id); ?>" class="text-sm text-gray-700 dark:text-gray-300">Représentant légal</label>
                                            <?php if($dirigeant->is_representant_legal): ?>
                                            <span class="px-2 py-0.5 text-xs font-semibold bg-teal-100 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300 rounded-full">RL</span>
                                            <?php endif; ?>
                                        </div>
                                        <button type="submit" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition-colors">
                                            Sauvegarder
                                        </button>
                                    </div>
                                </form>
                                <form action="<?php echo e(route('parametres.dirigeants.destroy', $dirigeant)); ?>" method="POST" class="mt-2 flex justify-end" 
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce dirigeant ?');">
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
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-8 text-center">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Aucun dirigeant</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Ajoutez les dirigeants de votre entreprise.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Associés Tab Content -->
        <div id="content-associes" class="tab-content hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Add New Associe Form -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Nouvel associé
                            </h3>
                            <form action="<?php echo e(route('parametres.associes.store')); ?>" method="POST" class="space-y-4">
                                <?php echo csrf_field(); ?>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom *</label>
                                        <input type="text" name="nom" required 
                                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Prénom</label>
                                        <input type="text" name="prenom" 
                                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">CIN</label>
                                    <input type="text" name="cin" 
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Parts sociales (DH)</label>
                                        <input type="number" name="parts_sociales" step="0.01" min="0"
                                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pourcentage (%)</label>
                                        <input type="number" name="pourcentage" step="0.01" min="0" max="100"
                                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Téléphone</label>
                                    <input type="text" name="telephone" 
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                    <input type="email" name="email" 
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                </div>
                                <button type="submit" class="w-full px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Ajouter l'associé
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Associes List -->
                    <div class="lg:col-span-2">
                        <?php if($settings->associes->count() > 0): ?>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $settings->associes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $associe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 sm:p-6">
                                <form action="<?php echo e(route('parametres.associes.update', $associe)); ?>" method="POST" class="space-y-4">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nom</label>
                                            <input type="text" name="nom" value="<?php echo e($associe->nom); ?>" required 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Prénom</label>
                                            <input type="text" name="prenom" value="<?php echo e($associe->prenom); ?>" 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">CIN</label>
                                            <input type="text" name="cin" value="<?php echo e($associe->cin); ?>" 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Téléphone</label>
                                            <input type="text" name="telephone" value="<?php echo e($associe->telephone); ?>" 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Email</label>
                                            <input type="email" name="email" value="<?php echo e($associe->email); ?>" 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Parts sociales (DH)</label>
                                            <input type="number" name="parts_sociales" value="<?php echo e($associe->parts_sociales); ?>" step="0.01" min="0"
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Pourcentage (%)</label>
                                            <input type="number" name="pourcentage" value="<?php echo e($associe->pourcentage); ?>" step="0.01" min="0" max="100"
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between flex-wrap gap-2">
                                        <div class="flex items-center gap-2">
                                            <?php if($associe->pourcentage): ?>
                                            <span class="px-2 py-0.5 text-xs font-semibold bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 rounded-full">
                                                <?php echo e(number_format($associe->pourcentage, 2)); ?>%
                                            </span>
                                            <?php endif; ?>
                                            <?php if($associe->parts_sociales): ?>
                                            <span class="px-2 py-0.5 text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full">
                                                <?php echo e(number_format($associe->parts_sociales, 2)); ?> DH
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition-colors">
                                            Sauvegarder
                                        </button>
                                    </div>
                                </form>
                                <form action="<?php echo e(route('parametres.associes.destroy', $associe)); ?>" method="POST" class="mt-2 flex justify-end" 
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet associé ?');">
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
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-8 text-center">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
                            </svg>
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Aucun associé</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Ajoutez les associés de votre entreprise.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function switchTab(tab) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Reset all tab buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('border-indigo-500', 'border-teal-500', 'border-amber-500', 'text-indigo-600', 'text-teal-600', 'text-amber-600', 'dark:text-indigo-400', 'dark:text-teal-400', 'dark:text-amber-400', 'bg-indigo-50/50', 'bg-teal-50/50', 'bg-amber-50/50', 'dark:bg-indigo-900/20', 'dark:bg-teal-900/20', 'dark:bg-amber-900/20');
        btn.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400', 'hover:text-gray-700', 'dark:hover:text-gray-300', 'hover:border-gray-300');
    });
    
    // Show selected tab content
    document.getElementById('content-' + tab).classList.remove('hidden');
    
    // Activate selected tab button
    const activeBtn = document.getElementById('tab-' + tab);
    activeBtn.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400', 'hover:text-gray-700', 'dark:hover:text-gray-300', 'hover:border-gray-300');
    
    if (tab === 'general') {
        activeBtn.classList.add('border-indigo-500', 'text-indigo-600', 'dark:text-indigo-400', 'bg-indigo-50/50', 'dark:bg-indigo-900/20');
    } else if (tab === 'dirigeants') {
        activeBtn.classList.add('border-teal-500', 'text-teal-600', 'dark:text-teal-400', 'bg-teal-50/50', 'dark:bg-teal-900/20');
    } else {
        activeBtn.classList.add('border-amber-500', 'text-amber-600', 'dark:text-amber-400', 'bg-amber-50/50', 'dark:bg-amber-900/20');
    }
}

// Check URL hash on page load
document.addEventListener('DOMContentLoaded', function() {
    const hash = window.location.hash.replace('#', '');
    if (hash === 'dirigeants' || hash === 'associes') {
        switchTab(hash);
    }
});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Espacegamers\Documents\abedrhman\resources\views/parametres/reglages-entreprise.blade.php ENDPATH**/ ?>