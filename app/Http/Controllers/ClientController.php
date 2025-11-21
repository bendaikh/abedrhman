<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Imports\ClientsImport;
use App\Exports\ClientsExport;
use Maatwebsite\Excel\Facades\Excel;

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
            'type' => 'required|in:particulier,societe',
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'type_piece_id' => 'nullable|string|max:255',
            'n_piece_id' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable|string|max:255',
            'nationalite' => 'nullable|string|max:255',
            'nom_raison_sociale' => 'nullable|string|max:255',
            'sigle' => 'nullable|string|max:255',
            'intitule' => 'nullable|string|max:255',
            'forme_juridique' => 'nullable|string|max:255',
            'piece_justificative' => 'nullable|string|max:255',
            'numero_piece' => 'nullable|string|max:255',
            'ice' => 'nullable|string|max:255',
            'id_fiscale' => 'nullable|string|max:255',
            'patente' => 'nullable|string|max:255',
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
            'source' => 'nullable|string|max:255',
            'intitule_source' => 'nullable|string|max:255',
            'intitule_source_data' => 'nullable|string|max:255',
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
            'type' => 'required|in:particulier,societe',
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'type_piece_id' => 'nullable|string|max:255',
            'n_piece_id' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable|string|max:255',
            'nationalite' => 'nullable|string|max:255',
            'nom_raison_sociale' => 'nullable|string|max:255',
            'sigle' => 'nullable|string|max:255',
            'intitule' => 'nullable|string|max:255',
            'forme_juridique' => 'nullable|string|max:255',
            'piece_justificative' => 'nullable|string|max:255',
            'numero_piece' => 'nullable|string|max:255',
            'ice' => 'nullable|string|max:255',
            'id_fiscale' => 'nullable|string|max:255',
            'patente' => 'nullable|string|max:255',
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
            'source' => 'nullable|string|max:255',
            'intitule_source' => 'nullable|string|max:255',
            'intitule_source_data' => 'nullable|string|max:255',
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

    /**
     * Import clients from Excel file
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new ClientsImport, $request->file('file'));
            
            return redirect()->route('clients.index')->with('success', 'Clients importés avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('clients.index')->with('error', 'Erreur lors de l\'importation: ' . $e->getMessage());
        }
    }

    /**
     * Export clients to Excel file
     */
    public function export()
    {
        return Excel::download(new ClientsExport, 'clients_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    /**
     * Download Excel template for import
     */
    public function downloadTemplate()
    {
        $headers = [
            'num_client',
            'type',
            'nom',
            'prenom',
            'fonction',
            'type_piece_id',
            'date_naissance',
            'lieu_naissance',
            'nationalite',
            'nom_raison_sociale',
            'sigle',
            'intitule',
            'forme_juridique',
            'piece_justificative',
            'numero_piece',
            'ice',
            'id_fiscale',
            'patente',
            'date_creation',
            'forme_juridique_creee',
            'siege_social',
            'ville',
            'pays',
            'secteur_activite',
            'activite',
            'autre_adresse_activite',
            'adresse_depot_magasin',
            'tel_1',
            'tel_2',
            'fixe',
            'email',
            'observations',
        ];

        $example = [
            '',
            'particulier',
            'Dupont',
            'Jean',
            'Directeur',
            'CIN',
            '1990-01-15',
            'Casablanca',
            'Marocain résident',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            'Casablanca',
            'Morocco',
            '',
            '',
            '',
            '',
            '0612345678',
            '',
            '',
            'jean.dupont@example.com',
            'Client VIP',
        ];

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Add headers
        $sheet->fromArray([$headers], null, 'A1');
        
        // Add example row
        $sheet->fromArray([$example], null, 'A2');

        // Style headers
        $headerStyle = $sheet->getStyle('A1:AC1');
        $headerStyle->getFont()->setBold(true);
        $headerStyle->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('4A90E2');
        $headerStyle->getFont()->getColor()->setRGB('FFFFFF');

        // Auto-size columns
        foreach (range('A', 'AC') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        
        $filename = 'template_import_clients.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($temp_file);

        return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
    }
}
