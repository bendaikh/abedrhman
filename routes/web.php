<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Redirect root to login or dashboard
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Protected Routes (require authentication)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard', ['page_title' => 'Tableau de bord']);
    })->name('dashboard');

    // Client import/export routes (must be before resource routes)
    Route::post('clients/import', [\App\Http\Controllers\ClientController::class, 'import'])->name('clients.import');
    Route::get('clients/export', [\App\Http\Controllers\ClientController::class, 'export'])->name('clients.export');
    Route::get('clients/template', [\App\Http\Controllers\ClientController::class, 'downloadTemplate'])->name('clients.template');
    
    // Service sections routes
    Route::resource('clients', \App\Http\Controllers\ClientController::class);

    // Actionnaires routes (nested under clients)
    Route::prefix('clients/{client}/actionnaires')->group(function () {
        Route::get('/', [\App\Http\Controllers\ActionnaireController::class, 'index'])->name('actionnaires.index');
        Route::get('/create', [\App\Http\Controllers\ActionnaireController::class, 'create'])->name('actionnaires.create');
        Route::post('/', [\App\Http\Controllers\ActionnaireController::class, 'store'])->name('actionnaires.store');
        Route::get('/{actionnaire}', [\App\Http\Controllers\ActionnaireController::class, 'show'])->name('actionnaires.show');
        Route::get('/{actionnaire}/edit', [\App\Http\Controllers\ActionnaireController::class, 'edit'])->name('actionnaires.edit');
        Route::put('/{actionnaire}', [\App\Http\Controllers\ActionnaireController::class, 'update'])->name('actionnaires.update');
        Route::delete('/{actionnaire}', [\App\Http\Controllers\ActionnaireController::class, 'destroy'])->name('actionnaires.destroy');
    });

    // Dirigeants routes (nested under clients)
    Route::prefix('clients/{client}/dirigeants')->group(function () {
        Route::get('/', [\App\Http\Controllers\DirigeantController::class, 'index'])->name('dirigeants.index');
        Route::get('/create', [\App\Http\Controllers\DirigeantController::class, 'create'])->name('dirigeants.create');
        Route::post('/', [\App\Http\Controllers\DirigeantController::class, 'store'])->name('dirigeants.store');
        Route::get('/{dirigeant}', [\App\Http\Controllers\DirigeantController::class, 'show'])->name('dirigeants.show');
        Route::get('/{dirigeant}/edit', [\App\Http\Controllers\DirigeantController::class, 'edit'])->name('dirigeants.edit');
        Route::put('/{dirigeant}', [\App\Http\Controllers\DirigeantController::class, 'update'])->name('dirigeants.update');
        Route::delete('/{dirigeant}', [\App\Http\Controllers\DirigeantController::class, 'destroy'])->name('dirigeants.destroy');
    });

    // Base tiers routes
    Route::get('/tiers', function () {
        $tab = request()->get('tab', 'fournisseurs');
        return view('sections.tiers', ['page_title' => 'Base tiers', 'activeTab' => $tab]);
    })->name('tiers.index');

    // Fournisseurs
    Route::resource('fournisseurs', \App\Http\Controllers\FournisseurController::class)->names([
        'index' => 'fournisseurs.index',
        'create' => 'fournisseurs.create',
        'store' => 'fournisseurs.store',
        'show' => 'fournisseurs.show',
        'edit' => 'fournisseurs.edit',
        'update' => 'fournisseurs.update',
        'destroy' => 'fournisseurs.destroy',
    ]);

    // Personnel
    Route::resource('personnel', \App\Http\Controllers\PersonnelController::class)->names([
        'index' => 'personnel.index',
        'create' => 'personnel.create',
        'store' => 'personnel.store',
        'show' => 'personnel.show',
        'edit' => 'personnel.edit',
        'update' => 'personnel.update',
        'destroy' => 'personnel.destroy',
    ]);

    // Administrations
    Route::resource('administrations', \App\Http\Controllers\AdministrationController::class)->names([
        'index' => 'administrations.index',
        'create' => 'administrations.create',
        'store' => 'administrations.store',
        'show' => 'administrations.show',
        'edit' => 'administrations.edit',
        'update' => 'administrations.update',
        'destroy' => 'administrations.destroy',
    ]);

    // Partenaires
    Route::resource('partenaires', \App\Http\Controllers\PartenaireController::class)->names([
        'index' => 'partenaires.index',
        'create' => 'partenaires.create',
        'store' => 'partenaires.store',
        'show' => 'partenaires.show',
        'edit' => 'partenaires.edit',
        'update' => 'partenaires.update',
        'destroy' => 'partenaires.destroy',
    ]);

    // Comptables
    Route::resource('comptables', \App\Http\Controllers\ComptableController::class)->names([
        'index' => 'comptables.index',
        'create' => 'comptables.create',
        'store' => 'comptables.store',
        'show' => 'comptables.show',
        'edit' => 'comptables.edit',
        'update' => 'comptables.update',
        'destroy' => 'comptables.destroy',
    ]);

    // Bailleurs
    Route::resource('bailleurs', \App\Http\Controllers\BailleurController::class)->names([
        'index' => 'bailleurs.index',
        'create' => 'bailleurs.create',
        'store' => 'bailleurs.store',
        'show' => 'bailleurs.show',
        'edit' => 'bailleurs.edit',
        'update' => 'bailleurs.update',
        'destroy' => 'bailleurs.destroy',
    ]);

    // Comptes Associés
    Route::resource('comptes-associes', \App\Http\Controllers\CompteAssocieController::class)->names([
        'index' => 'comptes-associes.index',
        'create' => 'comptes-associes.create',
        'store' => 'comptes-associes.store',
        'show' => 'comptes-associes.show',
        'edit' => 'comptes-associes.edit',
        'update' => 'comptes-associes.update',
        'destroy' => 'comptes-associes.destroy',
    ]);

    Route::get('/services', function () {
        return view('sections.services', ['page_title' => 'Services']);
    })->name('services');

    Route::get('/tarification', function () {
        return view('sections.tarification', ['page_title' => 'Tarification']);
    })->name('tarification');

    Route::get('/etapes-creation', function () {
        return view('sections.etapes-creation', ['page_title' => 'Étapes création']);
    })->name('etapes-creation');

    Route::get('/etapes-domiciliation', function () {
        return view('sections.etapes-domiciliation', ['page_title' => 'Étapes domiciliation']);
    })->name('etapes-domiciliation');

    // La gestion des achats
    Route::prefix('achats')->group(function () {
        Route::get('/bon-commande', function () {
        return view('achats.bon-commande', ['page_title' => 'Bon de commande']);
    })->name('achats.bon-commande');
    
    Route::get('/bon-reception', function () {
        return view('achats.bon-reception', ['page_title' => 'Bon de réception']);
    })->name('achats.bon-reception');
    
    Route::get('/reglements-fournisseurs', function () {
        return view('achats.reglements-fournisseurs', ['page_title' => 'Règlements fournisseurs']);
    })->name('achats.reglements-fournisseurs');
    
    Route::get('/historique', function () {
        return view('achats.historique', ['page_title' => 'Historique achats']);
    })->name('achats.historique');
    
    Route::get('/releve-compte-fournisseurs', function () {
        return view('achats.releve-compte-fournisseurs', ['page_title' => 'Relevé compte fournisseurs']);
    })->name('achats.releve-compte-fournisseurs');
    
    Route::get('/echeancier-fournisseurs', function () {
        return view('achats.echeancier-fournisseurs', ['page_title' => 'Échéancier fournisseurs']);
    })->name('achats.echeancier-fournisseurs');
});

    // La gestion des ventes
    Route::prefix('ventes')->group(function () {
        Route::get('/bon-commande', function () {
            return view('ventes.bon-commande', ['page_title' => 'Bon de commande']);
        })->name('ventes.bon-commande');
        
        Route::get('/bon-livraison', function () {
            return view('ventes.bon-livraison', ['page_title' => 'Bon de livraison']);
        })->name('ventes.bon-livraison');
        
        Route::get('/reglements-clients', function () {
            return view('ventes.reglements-clients', ['page_title' => 'Règlements clients']);
        })->name('ventes.reglements-clients');
        
        Route::get('/reglements-recouvrement', function () {
            return view('ventes.reglements-recouvrement', ['page_title' => 'Règlements recouvrement']);
        })->name('ventes.reglements-recouvrement');
        
        Route::get('/historique', function () {
            return view('ventes.historique', ['page_title' => 'Historique ventes']);
        })->name('ventes.historique');
        
        Route::get('/releve-compte-clients', function () {
            return view('ventes.releve-compte-clients', ['page_title' => 'Relevé compte clients']);
        })->name('ventes.releve-compte-clients');
});

    // La gestion du stock
    Route::prefix('stock')->group(function () {
        Route::get('/articles', function () {
            return view('stock.articles', ['page_title' => 'Articles']);
        })->name('stock.articles');
        
        Route::get('/familles', function () {
            return view('stock.familles', ['page_title' => 'Familles']);
        })->name('stock.familles');
        
        Route::get('/sous-familles', function () {
            return view('stock.sous-familles', ['page_title' => 'Sous-familles']);
        })->name('stock.sous-familles');
        
        Route::get('/unites-mesure', function () {
            return view('stock.unites-mesure', ['page_title' => 'Unités de mesure']);
        })->name('stock.unites-mesure');
        
        Route::get('/mouvement', function () {
            return view('stock.mouvement', ['page_title' => 'Mouvement stock']);
        })->name('stock.mouvement');
        
        Route::get('/stocks', function () {
            return view('stock.stocks', ['page_title' => 'Les stocks']);
        })->name('stock.stocks');
});

    // La gestion trésorerie
    Route::prefix('tresorerie')->group(function () {
        Route::get('/etat-journalier', function () {
            return view('tresorerie.etat-journalier', ['page_title' => 'État journalier']);
        })->name('tresorerie.etat-journalier');
        
        Route::get('/releve-reglements', function () {
            return view('tresorerie.releve-reglements', ['page_title' => 'Relevé règlements']);
        })->name('tresorerie.releve-reglements');
        
        Route::get('/balance-caisse', function () {
            return view('tresorerie.balance-caisse', ['page_title' => 'Balance caisse']);
        })->name('tresorerie.balance-caisse');
        
        Route::get('/liste-impots', function () {
            return view('tresorerie.liste-impots', ['page_title' => 'Liste rég impôts']);
        })->name('tresorerie.liste-impots');
        
        Route::get('/compte-bancaire', function () {
            return view('tresorerie.compte-bancaire', ['page_title' => 'Compte bancaire']);
        })->name('tresorerie.compte-bancaire');
        
        Route::get('/encaissement-decaissement', function () {
            return view('tresorerie.encaissement-decaissement', ['page_title' => 'Encaissement / Décaissement']);
        })->name('tresorerie.encaissement-decaissement');
        
        Route::get('/types-charges', function () {
            return view('tresorerie.types-charges', ['page_title' => 'Types de charges']);
        })->name('tresorerie.types-charges');
});

    // Old routes (kept for backward compatibility)
    Route::get('/blade-example', function () {
        return view('blade-example');
    })->name('blade-example');

    Route::get('/vue-example', function () {
        return view('vue-example');
    })->name('vue-example');
});
