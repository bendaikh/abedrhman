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
    
    // Tiers routes (Base tiers section)
    Route::resource('fournisseurs', \App\Http\Controllers\FournisseurController::class);
    Route::resource('personnel', \App\Http\Controllers\PersonnelController::class);
    Route::resource('administrations', \App\Http\Controllers\AdministrationController::class);
    Route::resource('partenaires', \App\Http\Controllers\PartenaireController::class);
    Route::resource('comptables', \App\Http\Controllers\ComptableController::class);
    Route::resource('bailleurs', \App\Http\Controllers\BailleurController::class);
    Route::resource('comptes-associes', \App\Http\Controllers\CompteAssocieController::class);

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

    Route::get('/tiers', function () {
        return view('sections.tiers', ['page_title' => 'Base tiers']);
    })->name('tiers.index');

    // Services CRUD
    Route::resource('services', \App\Http\Controllers\ServiceController::class);
    
    // Service Payments
    Route::get('services/{service}/payments', [\App\Http\Controllers\ServiceController::class, 'payments'])->name('services.payments');
    Route::post('services/{service}/payments', [\App\Http\Controllers\ServiceController::class, 'storePayment'])->name('services.payments.store');
    Route::delete('services/{service}/payments/{payment}', [\App\Http\Controllers\ServiceController::class, 'destroyPayment'])->name('services.payments.destroy');
    
    // Service Invoice
    Route::get('services/{service}/invoice', [\App\Http\Controllers\ServiceController::class, 'invoice'])->name('services.invoice');
    
    // Activités CRUD
    Route::resource('activites', \App\Http\Controllers\ActiviteController::class);

    Route::get('/tarification', function () {
        return view('sections.tarification', ['page_title' => 'Tarification']);
    })->name('tarification');

    Route::get('/etapes-creation', function () {
        return view('sections.etapes-creation', ['page_title' => 'Étapes création']);
    })->name('etapes-creation');

    Route::get('/etapes-domiciliation', function () {
        return view('sections.etapes-domiciliation', ['page_title' => 'Étapes domiciliation']);
    })->name('etapes-domiciliation');

    // Paramètres - Gestion DOM, CREA & Tarification
    Route::prefix('parametres')->group(function () {
        Route::get('/', [\App\Http\Controllers\ParametresController::class, 'index'])->name('parametres.index');
        
        // Offres DOM
        Route::get('/offres-dom', [\App\Http\Controllers\ParametresController::class, 'offresDom'])->name('parametres.offres-dom');
        Route::post('/offres-dom', [\App\Http\Controllers\ParametresController::class, 'storeOffreDom'])->name('parametres.offres-dom.store');
        Route::put('/offres-dom/{offreDom}', [\App\Http\Controllers\ParametresController::class, 'updateOffreDom'])->name('parametres.offres-dom.update');
        Route::delete('/offres-dom/{offreDom}', [\App\Http\Controllers\ParametresController::class, 'destroyOffreDom'])->name('parametres.offres-dom.destroy');
        
        // Offres CREA
        Route::get('/offres-crea', [\App\Http\Controllers\ParametresController::class, 'offresCrea'])->name('parametres.offres-crea');
        Route::post('/offres-crea', [\App\Http\Controllers\ParametresController::class, 'storeOffreCrea'])->name('parametres.offres-crea.store');
        Route::put('/offres-crea/{offreCrea}', [\App\Http\Controllers\ParametresController::class, 'updateOffreCrea'])->name('parametres.offres-crea.update');
        Route::delete('/offres-crea/{offreCrea}', [\App\Http\Controllers\ParametresController::class, 'destroyOffreCrea'])->name('parametres.offres-crea.destroy');
        
        // Types de tarification
        Route::get('/types-tarification', [\App\Http\Controllers\ParametresController::class, 'typesTarification'])->name('parametres.types-tarification');
        Route::post('/types-tarification', [\App\Http\Controllers\ParametresController::class, 'storeTypeTarification'])->name('parametres.types-tarification.store');
        Route::put('/types-tarification/{typeTarification}', [\App\Http\Controllers\ParametresController::class, 'updateTypeTarification'])->name('parametres.types-tarification.update');
        Route::delete('/types-tarification/{typeTarification}', [\App\Http\Controllers\ParametresController::class, 'destroyTypeTarification'])->name('parametres.types-tarification.destroy');
        
        // Grille tarifaire DOM
        Route::get('/tarifications-dom', [\App\Http\Controllers\ParametresController::class, 'tarificationsDom'])->name('parametres.tarifications-dom');
        Route::put('/tarifications-dom', [\App\Http\Controllers\ParametresController::class, 'updateTarificationsDom'])->name('parametres.tarifications-dom.update');
        
        // Grille tarifaire CREA
        Route::get('/tarifications-crea', [\App\Http\Controllers\ParametresController::class, 'tarificationsCrea'])->name('parametres.tarifications-crea');
        Route::put('/tarifications-crea', [\App\Http\Controllers\ParametresController::class, 'updateTarificationsCrea'])->name('parametres.tarifications-crea.update');
        
        // Types de services
        Route::get('/types-services', [\App\Http\Controllers\ParametresController::class, 'typesServices'])->name('parametres.types-services');
        Route::post('/types-services', [\App\Http\Controllers\ParametresController::class, 'storeTypeService'])->name('parametres.types-services.store');
        Route::put('/types-services/{typeService}', [\App\Http\Controllers\ParametresController::class, 'updateTypeService'])->name('parametres.types-services.update');
        Route::delete('/types-services/{typeService}', [\App\Http\Controllers\ParametresController::class, 'destroyTypeService'])->name('parametres.types-services.destroy');
        
        // Types d'activités
        Route::get('/types-activites', [\App\Http\Controllers\ParametresController::class, 'typesActivites'])->name('parametres.types-activites');
        Route::post('/types-activites', [\App\Http\Controllers\ParametresController::class, 'storeTypeActivite'])->name('parametres.types-activites.store');
        Route::put('/types-activites/{typeActivite}', [\App\Http\Controllers\ParametresController::class, 'updateTypeActivite'])->name('parametres.types-activites.update');
        Route::delete('/types-activites/{typeActivite}', [\App\Http\Controllers\ParametresController::class, 'destroyTypeActivite'])->name('parametres.types-activites.destroy');
    });

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
