<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::orderBy('created_at', 'desc')->paginate(15);
        return view('sections.clients', [
            'page_title' => 'Base clientèle',
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sections.clients-form', [
            'page_title' => 'Créer un client',
            'client' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:particulier,Entreprise',
            'nom_raison_sociale' => 'nullable|string|max:255',
            'sigle' => 'nullable|string|max:255',
            'intitule' => 'nullable|string|max:255',
            'forme_juridique' => 'nullable|string|max:255',
            'piece_justificative' => 'nullable|string|max:255',
            'numero_piece' => 'nullable|string|max:255',
            'date_creation' => 'nullable|date',
            'forme_juridique_creee' => 'nullable|string|max:255',
            'siege_social' => 'nullable|string',
            'ville' => 'nullable|string|max:255',
            'pays' => 'nullable|string|max:255',
            'secteur_activite' => 'nullable|string|max:255',
            'activite' => 'nullable|string|max:255',
            'autre_adresse_activite' => 'nullable|string',
            'adresse_depot_magasin' => 'nullable|string',
            'tel_1' => 'nullable|string|max:255',
            'tel_2' => 'nullable|string|max:255',
            'fixe' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'observations' => 'nullable|string',
        ]);

        // Generate client number if not provided
        if (empty($validated['num_client'])) {
            $validated['num_client'] = Client::generateClientNumber();
        }

        Client::create($validated);

        return redirect()->route('clients.index')->with('success', 'Client créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::findOrFail($id);
        return view('sections.clients-show', [
            'page_title' => 'Détails du client',
            'client' => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::findOrFail($id);
        return view('sections.clients-form', [
            'page_title' => 'Modifier le client',
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|in:particulier,Entreprise',
            'nom_raison_sociale' => 'nullable|string|max:255',
            'sigle' => 'nullable|string|max:255',
            'intitule' => 'nullable|string|max:255',
            'forme_juridique' => 'nullable|string|max:255',
            'piece_justificative' => 'nullable|string|max:255',
            'numero_piece' => 'nullable|string|max:255',
            'date_creation' => 'nullable|date',
            'forme_juridique_creee' => 'nullable|string|max:255',
            'siege_social' => 'nullable|string',
            'ville' => 'nullable|string|max:255',
            'pays' => 'nullable|string|max:255',
            'secteur_activite' => 'nullable|string|max:255',
            'activite' => 'nullable|string|max:255',
            'autre_adresse_activite' => 'nullable|string',
            'adresse_depot_magasin' => 'nullable|string',
            'tel_1' => 'nullable|string|max:255',
            'tel_2' => 'nullable|string|max:255',
            'fixe' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'observations' => 'nullable|string',
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')->with('success', 'Client modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }
}
