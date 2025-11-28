<?php

namespace App\Http\Controllers;

use App\Models\Bailleur;
use Illuminate\Http\Request;

class BailleurController extends Controller
{
    public function index()
    {
        $bailleurs = Bailleur::orderBy('created_at', 'desc')->paginate(15);
        return view('tiers.bailleurs.index', [
            'page_title' => 'Bailleurs',
            'bailleurs' => $bailleurs
        ]);
    }

    public function create()
    {
        return view('tiers.bailleurs.form', [
            'page_title' => 'Créer un bailleur',
            'bailleur' => null
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

        Bailleur::create($validated);

        return redirect()->route('tiers.index', ['tab' => 'bailleurs'])->with('success', 'Bailleur créé avec succès.');
    }

    public function show(string $id)
    {
        $bailleur = Bailleur::findOrFail($id);
        return view('tiers.bailleurs.show', [
            'page_title' => 'Détails du bailleur',
            'bailleur' => $bailleur
        ]);
    }

    public function edit(string $id)
    {
        $bailleur = Bailleur::findOrFail($id);
        return view('tiers.bailleurs.form', [
            'page_title' => 'Modifier le bailleur',
            'bailleur' => $bailleur
        ]);
    }

    public function update(Request $request, string $id)
    {
        $bailleur = Bailleur::findOrFail($id);

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

        $bailleur->update($validated);

        return redirect()->route('tiers.index', ['tab' => 'bailleurs'])->with('success', 'Bailleur modifié avec succès.');
    }

    public function destroy(string $id)
    {
        $bailleur = Bailleur::findOrFail($id);
        $bailleur->delete();

        return redirect()->route('tiers.index', ['tab' => 'bailleurs'])->with('success', 'Bailleur supprimé avec succès.');
    }
}
