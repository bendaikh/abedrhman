<?php

namespace App\Http\Controllers;

use App\Models\Comptable;
use Illuminate\Http\Request;

class ComptableController extends Controller
{
    public function index()
    {
        $comptables = Comptable::orderBy('created_at', 'desc')->paginate(15);
        return view('tiers.comptables.index', [
            'page_title' => 'Comptables',
            'comptables' => $comptables
        ]);
    }

    public function create()
    {
        return view('tiers.comptables.form', [
            'page_title' => 'Créer un comptable',
            'comptable' => null
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
            'prestation' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'ice' => 'nullable|string|max:255',
            'rib' => 'nullable|string|max:255',
        ]);

        Comptable::create($validated);

        return redirect()->route('tiers.index', ['tab' => 'comptables'])->with('success', 'Comptable créé avec succès.');
    }

    public function show(string $id)
    {
        $comptable = Comptable::findOrFail($id);
        return view('tiers.comptables.show', [
            'page_title' => 'Détails du comptable',
            'comptable' => $comptable
        ]);
    }

    public function edit(string $id)
    {
        $comptable = Comptable::findOrFail($id);
        return view('tiers.comptables.form', [
            'page_title' => 'Modifier le comptable',
            'comptable' => $comptable
        ]);
    }

    public function update(Request $request, string $id)
    {
        $comptable = Comptable::findOrFail($id);

        $validated = $request->validate([
            'raison_sociale' => 'nullable|string|max:255',
            'responsable_nom' => 'nullable|string|max:255',
            'responsable_prenom' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'activite' => 'nullable|string|max:255',
            'prestation' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'ice' => 'nullable|string|max:255',
            'rib' => 'nullable|string|max:255',
        ]);

        $comptable->update($validated);

        return redirect()->route('tiers.index', ['tab' => 'comptables'])->with('success', 'Comptable modifié avec succès.');
    }

    public function destroy(string $id)
    {
        $comptable = Comptable::findOrFail($id);
        $comptable->delete();

        return redirect()->route('tiers.index', ['tab' => 'comptables'])->with('success', 'Comptable supprimé avec succès.');
    }

    /**
     * Get comptables list for source dropdown (AJAX)
     */
    public function getComptablesForSource()
    {
        $comptables = Comptable::select('id', 'raison_sociale')
            ->whereNotNull('raison_sociale')
            ->orderBy('raison_sociale')
            ->get()
            ->map(function($comptable) {
                return [
                    'id' => $comptable->id,
                    'name' => $comptable->raison_sociale
                ];
            });
        
        return response()->json($comptables);
    }
}
