<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index()
    {
        $fournisseurs = Fournisseur::orderBy('created_at', 'desc')->paginate(15);
        return view('tiers.fournisseurs.index', [
            'page_title' => 'Fournisseurs',
            'fournisseurs' => $fournisseurs
        ]);
    }

    public function create()
    {
        return view('tiers.fournisseurs.form', [
            'page_title' => 'Créer un fournisseur',
            'fournisseur' => null
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'raison_sociale' => 'nullable|string|max:255',
            'responsable_nom' => 'nullable|string|max:255',
            'responsable_prenom' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'activite' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'ice' => 'nullable|string|max:255',
            'rib' => 'nullable|string|max:255',
        ]);

        Fournisseur::create($validated);

        return redirect()->route('tiers.index', ['tab' => 'fournisseurs'])->with('success', 'Fournisseur créé avec succès.');
    }

    public function show(string $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        return view('tiers.fournisseurs.show', [
            'page_title' => 'Détails du fournisseur',
            'fournisseur' => $fournisseur
        ]);
    }

    public function edit(string $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        return view('tiers.fournisseurs.form', [
            'page_title' => 'Modifier le fournisseur',
            'fournisseur' => $fournisseur
        ]);
    }

    public function update(Request $request, string $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);

        $validated = $request->validate([
            'raison_sociale' => 'nullable|string|max:255',
            'responsable_nom' => 'nullable|string|max:255',
            'responsable_prenom' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'activite' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'ice' => 'nullable|string|max:255',
            'rib' => 'nullable|string|max:255',
        ]);

        $fournisseur->update($validated);

        return redirect()->route('tiers.index', ['tab' => 'fournisseurs'])->with('success', 'Fournisseur modifié avec succès.');
    }

    public function destroy(string $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->delete();

        return redirect()->route('tiers.index', ['tab' => 'fournisseurs'])->with('success', 'Fournisseur supprimé avec succès.');
    }
}

