<?php

namespace App\Http\Controllers;

use App\Models\Actionnaire;
use App\Models\Client;
use Illuminate\Http\Request;

class ActionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($clientId)
    {
        $client = Client::findOrFail($clientId);
        
        if ($client->type !== 'societe') {
            return redirect()->route('clients.index')->with('error', 'Les actionnaires sont uniquement disponibles pour les entreprises.');
        }

        $actionnaires = $client->actionnaires()->get();
        
        return view('sections.actionnaires', compact('client', 'actionnaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($clientId)
    {
        $client = Client::findOrFail($clientId);
        
        if ($client->type !== 'societe') {
            return redirect()->route('clients.index')->with('error', 'Les actionnaires sont uniquement disponibles pour les entreprises.');
        }

        return view('sections.actionnaires-form', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $clientId)
    {
        $client = Client::findOrFail($clientId);
        
        $validated = $request->validate([
            'intitule' => 'nullable|string|max:255',
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'part_sociale_pct' => 'nullable|numeric|min:0|max:100',
            'piece_id' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable|string|max:255',
            'nationalite' => 'nullable|string|max:255',
            'adresse' => 'nullable|string',
            'ville' => 'nullable|string|max:255',
            'pays' => 'nullable|string|max:255',
            'tel1_resp' => 'nullable|string|max:255',
            'tel2_resp' => 'nullable|string|max:255',
            'email_resp' => 'nullable|email|max:255',
        ]);

        // Validate total part sociale percentage
        if (isset($validated['part_sociale_pct'])) {
            $currentTotal = $client->actionnaires()->sum('part_sociale_pct');
            $newTotal = $currentTotal + $validated['part_sociale_pct'];
            
            if ($newTotal > 100) {
                return back()->withErrors([
                    'part_sociale_pct' => 'Le total des parts sociales ne doit pas dépasser 100%. Total actuel: ' . $currentTotal . '%, vous essayez d\'ajouter: ' . $validated['part_sociale_pct'] . '%.'
                ])->withInput();
            }
        }

        $validated['client_id'] = $clientId;
        Actionnaire::create($validated);

        return redirect()->route('actionnaires.index', $clientId)->with('success', 'Actionnaire ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($clientId, $id)
    {
        $client = Client::findOrFail($clientId);
        $actionnaire = Actionnaire::where('client_id', $clientId)->findOrFail($id);
        
        return view('sections.actionnaires-show', compact('client', 'actionnaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($clientId, $id)
    {
        $client = Client::findOrFail($clientId);
        $actionnaire = Actionnaire::where('client_id', $clientId)->findOrFail($id);
        
        return view('sections.actionnaires-form', compact('client', 'actionnaire'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $clientId, $id)
    {
        $actionnaire = Actionnaire::where('client_id', $clientId)->findOrFail($id);
        $client = Client::findOrFail($clientId);
        
        $validated = $request->validate([
            'intitule' => 'nullable|string|max:255',
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'part_sociale_pct' => 'nullable|numeric|min:0|max:100',
            'piece_id' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable|string|max:255',
            'nationalite' => 'nullable|string|max:255',
            'adresse' => 'nullable|string',
            'ville' => 'nullable|string|max:255',
            'pays' => 'nullable|string|max:255',
            'tel1_resp' => 'nullable|string|max:255',
            'tel2_resp' => 'nullable|string|max:255',
            'email_resp' => 'nullable|email|max:255',
        ]);

        // Validate total part sociale percentage
        if (isset($validated['part_sociale_pct'])) {
            $currentTotal = $client->actionnaires()
                ->where('id', '!=', $id)
                ->sum('part_sociale_pct');
            $newTotal = $currentTotal + $validated['part_sociale_pct'];
            
            if ($newTotal > 100) {
                return back()->withErrors([
                    'part_sociale_pct' => 'Le total des parts sociales ne doit pas dépasser 100%. Total actuel (sans cet actionnaire): ' . $currentTotal . '%, vous essayez d\'ajouter: ' . $validated['part_sociale_pct'] . '%.'
                ])->withInput();
            }
        }

        $actionnaire->update($validated);

        return redirect()->route('actionnaires.index', $clientId)->with('success', 'Actionnaire modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($clientId, $id)
    {
        $actionnaire = Actionnaire::where('client_id', $clientId)->findOrFail($id);
        $actionnaire->delete();

        return redirect()->route('actionnaires.index', $clientId)->with('success', 'Actionnaire supprimé avec succès.');
    }
}
