<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\TypeActivite;
use Illuminate\Http\Request;

class ActiviteController extends Controller
{
    /**
     * Display a listing of the activites.
     */
    public function index()
    {
        $activites = Activite::with('typeActivite')->latest()->get();
        $typesActivites = TypeActivite::active()->ordered()->get();

        return view('sections.activites', [
            'page_title' => 'Activités',
            'activites' => $activites,
            'typesActivites' => $typesActivites,
        ]);
    }

    /**
     * Show the form for creating a new activite.
     */
    public function create()
    {
        $typesActivites = TypeActivite::active()->ordered()->get();

        return view('sections.activites-create', [
            'page_title' => 'Nouvelle activité',
            'typesActivites' => $typesActivites,
        ]);
    }

    /**
     * Store a newly created activite in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type_activite_id' => 'required|exists:types_activites,id',
            'description' => 'nullable|string|max:1000',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'lieu' => 'nullable|string|max:255',
            'capacite' => 'nullable|integer|min:1',
            'prix' => 'nullable|numeric|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Activite::create($validated);

        return redirect()->route('activites.index')
            ->with('success', 'Activité créée avec succès.');
    }

    /**
     * Display the specified activite.
     */
    public function show(Activite $activite)
    {
        return view('sections.activites-show', [
            'page_title' => $activite->nom,
            'activite' => $activite->load('typeActivite'),
        ]);
    }

    /**
     * Show the form for editing the specified activite.
     */
    public function edit(Activite $activite)
    {
        $typesActivites = TypeActivite::active()->ordered()->get();

        return view('sections.activites-edit', [
            'page_title' => 'Modifier l\'activité',
            'activite' => $activite,
            'typesActivites' => $typesActivites,
        ]);
    }

    /**
     * Update the specified activite in storage.
     */
    public function update(Request $request, Activite $activite)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type_activite_id' => 'required|exists:types_activites,id',
            'description' => 'nullable|string|max:1000',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'lieu' => 'nullable|string|max:255',
            'capacite' => 'nullable|integer|min:1',
            'prix' => 'nullable|numeric|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $activite->update($validated);

        return redirect()->route('activites.index')
            ->with('success', 'Activité mise à jour avec succès.');
    }

    /**
     * Remove the specified activite from storage.
     */
    public function destroy(Activite $activite)
    {
        $activite->delete();

        return redirect()->route('activites.index')
            ->with('success', 'Activité supprimée avec succès.');
    }
}
















