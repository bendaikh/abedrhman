<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Payment;
use App\Models\Service;
use App\Models\SousService;
use App\Models\TypeService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index()
    {
        $services = Service::with(['typeService', 'client', 'payments', 'sousServices'])->latest()->get();
        $typesServices = TypeService::active()->ordered()->get();

        return view('sections.services', [
            'page_title' => 'Services',
            'services' => $services,
            'typesServices' => $typesServices,
        ]);
    }

    /**
     * Show the form for creating a new service.
     */
    public function create(Request $request)
    {
        $typesServices = TypeService::active()->ordered()->get();
        $clients = Client::orderBy('nom_raison_sociale')->orderBy('nom')->get();
        $sousServices = SousService::active()->ordered()->get();
        $selectedTypeServiceId = $request->get('type_service_id');

        return view('sections.services-create', [
            'page_title' => 'Nouveau service',
            'typesServices' => $typesServices,
            'clients' => $clients,
            'sousServices' => $sousServices,
            'selectedTypeServiceId' => $selectedTypeServiceId,
        ]);
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'type_service_id' => 'required|exists:types_services,id',
            'description' => 'nullable|string|max:1000',
            'prix' => 'required|numeric|min:0',
            'sous_services' => 'nullable|array',
            'sous_services.*' => 'exists:sous_services,id',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['status'] = 'initialiser'; // Set initial status

        $service = Service::create($validated);
        
        // Attach sous-services if provided
        if (!empty($validated['sous_services'])) {
            $service->sousServices()->sync($validated['sous_services']);
        }

        return redirect()->route('services.index')
            ->with('success', 'Service créé avec succès.');
    }

    /**
     * Display the specified service.
     */
    public function show(Service $service)
    {
        return view('sections.services-show', [
            'page_title' => 'Détails du service',
            'service' => $service->load(['typeService', 'client', 'payments', 'sousServices']),
        ]);
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service)
    {
        $typesServices = TypeService::active()->ordered()->get();
        $clients = Client::orderBy('nom_raison_sociale')->orderBy('nom')->get();

        return view('sections.services-edit', [
            'page_title' => 'Modifier le service',
            'service' => $service->load(['client', 'payments']),
            'typesServices' => $typesServices,
            'clients' => $clients,
        ]);
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'type_service_id' => 'required|exists:types_services,id',
            'description' => 'nullable|string|max:1000',
            'prix' => 'required|numeric|min:0',
            'status' => 'required|in:initialiser,en_cours,termine,annule',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $service->update($validated);

        return redirect()->route('services.index')
            ->with('success', 'Service mis à jour avec succès.');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service supprimé avec succès.');
    }

    /**
     * Show payment management for a service
     */
    public function payments(Service $service)
    {
        return view('sections.services-payments', [
            'page_title' => 'Gestion des paiements',
            'service' => $service->load(['typeService', 'client', 'payments', 'sousServices']),
        ]);
    }

    /**
     * Store a new payment for a service
     */
    public function storePayment(Request $request, Service $service)
    {
        $validated = $request->validate([
            'montant' => 'required|numeric|min:0.01',
            'mode_paiement' => 'required|in:especes,cheque,virement,carte,lcn',
            'reference' => 'nullable|string|max:255',
            'numero_transaction' => 'nullable|string|max:255',
            'date_emission' => 'nullable|date',
            'date_echeance' => 'nullable|date',
            'encaisse' => 'nullable|boolean',
            'commentaire' => 'nullable|string|max:1000',
            'date_paiement' => 'required|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Set default type to 'paiement'
        $validated['type'] = 'paiement';

        // Set encaisse default to true if not provided
        $validated['encaisse'] = $request->has('encaisse') ? true : false;

        // Auto-generate receipt number
        $validated['numero_recu'] = $this->generateReceiptNumber($validated['date_paiement']);

        $service->payments()->create($validated);

        return redirect()->route('services.payments', $service)
            ->with('success', 'Paiement enregistré avec succès.');
    }

    /**
     * Generate a unique receipt number
     */
    private function generateReceiptNumber($date): string
    {
        $dateObj = is_string($date) ? Carbon::parse($date) : $date;
        $datePrefix = $dateObj->format('Ymd');

        // Get the last receipt number for this date
        $lastReceipt = Payment::whereDate('date_paiement', $dateObj->format('Y-m-d'))
            ->whereNotNull('numero_recu')
            ->where('numero_recu', 'like', "REC-{$datePrefix}-%")
            ->orderBy('numero_recu', 'desc')
            ->first();

        if ($lastReceipt && $lastReceipt->numero_recu) {
            // Extract the sequence number from the last receipt
            $parts = explode('-', $lastReceipt->numero_recu);
            if (count($parts) === 3) {
                $sequence = (int) $parts[2];
                $sequence++;
            } else {
                $sequence = 1;
            }
        } else {
            $sequence = 1;
        }

        // Format: REC-YYYYMMDD-XXX (with leading zeros)
        return sprintf('REC-%s-%03d', $datePrefix, $sequence);
    }

    /**
     * Delete a payment
     */
    public function destroyPayment(Service $service, Payment $payment)
    {
        if ($payment->service_id !== $service->id) {
            abort(404);
        }

        $payment->delete();

        return redirect()->route('services.payments', $service)
            ->with('success', 'Paiement supprimé avec succès.');
    }

    /**
     * Toggle encaisse status for a payment
     */
    public function toggleEncaisse(Payment $payment)
    {
        $payment->update(['encaisse' => !$payment->encaisse]);

        return redirect()->back()
            ->with('success', 'Statut d\'encaissement mis à jour avec succès.');
    }

    /**
     * Store a global payment (from payments page)
     */
    public function storeGlobalPayment(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'montant' => 'required|numeric|min:0.01',
            'mode_paiement' => 'required|in:especes,cheque,virement,carte,lcn',
            'reference' => 'nullable|string|max:255',
            'numero_transaction' => 'nullable|string|max:255',
            'date_emission' => 'nullable|date',
            'date_echeance' => 'nullable|date',
            'encaisse' => 'nullable|boolean',
            'commentaire' => 'nullable|string|max:1000',
            'date_paiement' => 'required|date',
        ]);

        $validated['type'] = 'paiement';
        $validated['encaisse'] = $request->has('encaisse') ? true : false;
        $validated['numero_recu'] = $this->generateReceiptNumber($validated['date_paiement']);

        Payment::create($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Paiement enregistré avec succès.');
    }

    /**
     * Get client details for AJAX request
     */
    public function getClientDetails(Client $client)
    {
        return response()->json([
            'id' => $client->id,
            'nom' => $client->type === 'morale' 
                ? $client->nom_raison_sociale 
                : ($client->nom . ' ' . $client->prenom),
            'gerant' => $client->type === 'morale' 
                ? ($client->dirigeants->first()->nom ?? 'N/A') 
                : 'N/A',
            'ville' => $client->ville ?? 'N/A',
            'type' => $client->type,
        ]);
    }

    /**
     * Display invoice for a service
     */
    public function invoice(Service $service)
    {
        return view('sections.services-invoice', [
            'service' => $service->load(['typeService', 'client.dirigeants', 'payments', 'sousServices']),
        ]);
    }

    /**
     * Display all payments across all services
     */
    public function allPayments(Request $request)
    {
        $query = Payment::with(['service.typeService', 'service.client']);

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('service.client', function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('nom_raison_sociale', 'like', "%{$search}%");
            })->orWhere('reference', 'like', "%{$search}%");
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('mode')) {
            $query->where('mode_paiement', $request->mode);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date_paiement', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date_paiement', '<=', $request->date_to);
        }

        $payments = $query->orderBy('date_paiement', 'desc')->paginate(20)->withQueryString();

        // Calculate statistics
        $totalAmount = Payment::sum('montant');
        $todayAmount = Payment::whereDate('date_paiement', today())->sum('montant');
        $monthAmount = Payment::whereMonth('date_paiement', now()->month)
            ->whereYear('date_paiement', now()->year)
            ->sum('montant');
        
        // Encaissé statistics
        $encaisseCount = Payment::where('encaisse', true)->count();
        $encaisseAmount = Payment::where('encaisse', true)->sum('montant');
        $nonEncaisseCount = Payment::where('encaisse', false)->count();
        $nonEncaisseAmount = Payment::where('encaisse', false)->sum('montant');
        
        // Get clients with services for the payment form
        $clients = Client::with(['services' => function($q) {
            $q->with('typeService')->orderBy('created_at', 'desc');
        }])->orderBy('nom_raison_sociale')->orderBy('nom')->get();

        return view('sections.payments', [
            'page_title' => 'Gestion des Paiements',
            'payments' => $payments,
            'totalAmount' => $totalAmount,
            'todayAmount' => $todayAmount,
            'monthAmount' => $monthAmount,
            'encaisseCount' => $encaisseCount,
            'encaisseAmount' => $encaisseAmount,
            'nonEncaisseCount' => $nonEncaisseCount,
            'nonEncaisseAmount' => $nonEncaisseAmount,
            'clients' => $clients,
        ]);
    }

    /**
     * Show sous-services management for a service
     */
    public function sousServices(Service $service)
    {
        $allSousServices = SousService::active()->ordered()->get();
        
        return view('sections.services-sous-services', [
            'page_title' => 'Gestion des sous-services',
            'service' => $service->load(['typeService', 'client', 'sousServices']),
            'allSousServices' => $allSousServices,
        ]);
    }

    /**
     * Sync sous-services for a service
     */
    public function syncSousServices(Request $request, Service $service)
    {
        $validated = $request->validate([
            'sous_services' => 'nullable|array',
            'sous_services.*' => 'exists:sous_services,id',
        ]);

        $sousServiceIds = $validated['sous_services'] ?? [];
        $service->sousServices()->sync($sousServiceIds);

        return redirect()->route('services.sous-services', $service)
            ->with('success', 'Sous-services mis à jour avec succès. Le montant total a été recalculé.');
    }

    /**
     * Display all payment receipts from services
     */
    public function recusPaiements(Request $request)
    {
        $query = Service::with(['typeService', 'client', 'payments', 'sousServices'])
            ->whereHas('payments'); // Only services that have payments

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('client', function ($q2) use ($search) {
                    $q2->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%")
                      ->orWhere('nom_raison_sociale', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('type_service')) {
            $query->where('type_service_id', $request->type_service);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $services = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        $typesServices = TypeService::active()->ordered()->get();

        // Statistics
        $totalServices = Service::whereHas('payments')->count();
        $totalPaid = Payment::sum('montant');
        $fullyPaidServices = Service::whereHas('payments')
            ->get()
            ->filter(fn($s) => $s->remaining_amount <= 0)
            ->count();

        return view('sections.recus-paiements', [
            'page_title' => 'Les reçus de paiements',
            'services' => $services,
            'typesServices' => $typesServices,
            'totalServices' => $totalServices,
            'totalPaid' => $totalPaid,
            'fullyPaidServices' => $fullyPaidServices,
        ]);
    }
}


