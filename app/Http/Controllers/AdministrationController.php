<?php

namespace App\Http\Controllers;

use App\Models\Administration;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public function index()
    {
        $administrations = Administration::orderBy('created_at', 'desc')->paginate(15);
        return view('tiers.administrations.index', [
            'page_title' => 'Administrations',
            'administrations' => $administrations
        ]);
    }

    public function create()
    {
        return view('tiers.administrations.form', [
            'page_title' => 'Créer une administration',
            'administration' => null
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'raison_sociale' => 'nullable|string|max:255',
            'responsable_nom' => 'nullable|string|max:255',
            'responsable_prenom' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
        ]);

        Administration::create($validated);

        return redirect()->route('tiers.index', ['tab' => 'administrations'])->with('success', 'Administration créée avec succès.');
    }

    public function show(string $id)
    {
        $administration = Administration::findOrFail($id);
        return view('tiers.administrations.show', [
            'page_title' => 'Détails de l\'administration',
            'administration' => $administration
        ]);
    }

    public function edit(string $id)
    {
        $administration = Administration::findOrFail($id);
        return view('tiers.administrations.form', [
            'page_title' => 'Modifier l\'administration',
            'administration' => $administration
        ]);
    }

    public function update(Request $request, string $id)
    {
        $administration = Administration::findOrFail($id);

        $validated = $request->validate([
            'raison_sociale' => 'nullable|string|max:255',
            'responsable_nom' => 'nullable|string|max:255',
            'responsable_prenom' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
        ]);

        $administration->update($validated);

        return redirect()->route('tiers.index', ['tab' => 'administrations'])->with('success', 'Administration modifiée avec succès.');
    }

    public function destroy(string $id)
    {
        $administration = Administration::findOrFail($id);
        $administration->delete();

        return redirect()->route('tiers.index', ['tab' => 'administrations'])->with('success', 'Administration supprimée avec succès.');
    }

    /**
     * Get administrations list for source dropdown (AJAX)
     */
    public function getAdministrationsForSource()
    {
        $administrations = Administration::select('id', 'raison_sociale')
            ->whereNotNull('raison_sociale')
            ->orderBy('raison_sociale')
            ->get()
            ->map(function($administration) {
                return [
                    'id' => $administration->id,
                    'name' => $administration->raison_sociale
                ];
            });
        
        return response()->json($administrations);
    }
}
