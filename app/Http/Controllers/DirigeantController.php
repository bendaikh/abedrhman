<?php

namespace App\Http\Controllers;

use App\Models\Dirigeant;
use App\Models\Client;
use Illuminate\Http\Request;

class DirigeantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($clientId)
    {
        $client = Client::findOrFail($clientId);
        
        if ($client->type !== 'societe') {
            return redirect()->route('clients.index')->with('error', 'Les dirigeants sont uniquement disponibles pour les entreprises.');
        }

        $dirigeants = $client->dirigeants()->get();
        
        return view('sections.dirigeants', compact('client', 'dirigeants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($clientId)
    {
        $client = Client::findOrFail($clientId);
        
        if ($client->type !== 'societe') {
            return redirect()->route('clients.index')->with('error', 'Les dirigeants sont uniquement disponibles pour les entreprises.');
        }

        return view('sections.dirigeants-form', compact('client'));
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
            'fonction' => 'nullable|string|max:255',
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

        $validated['client_id'] = $clientId;
        Dirigeant::create($validated);

        return redirect()->route('dirigeants.index', $clientId)->with('success', 'Dirigeant ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($clientId, $id)
    {
        $client = Client::findOrFail($clientId);
        $dirigeant = Dirigeant::where('client_id', $clientId)->findOrFail($id);
        
        return view('sections.dirigeants-show', compact('client', 'dirigeant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($clientId, $id)
    {
        $client = Client::findOrFail($clientId);
        $dirigeant = Dirigeant::where('client_id', $clientId)->findOrFail($id);
        
        return view('sections.dirigeants-form', compact('client', 'dirigeant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $clientId, $id)
    {
        $dirigeant = Dirigeant::where('client_id', $clientId)->findOrFail($id);
        
        $validated = $request->validate([
            'intitule' => 'nullable|string|max:255',
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
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

        $dirigeant->update($validated);

        return redirect()->route('dirigeants.index', $clientId)->with('success', 'Dirigeant modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($clientId, $id)
    {
        $dirigeant = Dirigeant::where('client_id', $clientId)->findOrFail($id);
        $dirigeant->delete();

        return redirect()->route('dirigeants.index', $clientId)->with('success', 'Dirigeant supprimé avec succès.');
    }
}
