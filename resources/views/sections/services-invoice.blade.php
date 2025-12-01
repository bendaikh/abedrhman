<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture #{{ str_pad($service->id, 6, '0', STR_PAD_LEFT) }} - Abedrhman</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .invoice-header {
            background: linear-gradient(135deg, #0d9488, #0891b2);
            color: white;
            padding: 30px 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        
        .company-info h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .company-info p {
            opacity: 0.9;
            font-size: 14px;
        }
        
        .invoice-title {
            text-align: right;
        }
        
        .invoice-title h2 {
            font-size: 32px;
            font-weight: 300;
            margin-bottom: 5px;
        }
        
        .invoice-title .invoice-number {
            font-size: 16px;
            opacity: 0.9;
        }
        
        .invoice-body {
            padding: 40px;
        }
        
        .invoice-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            gap: 40px;
        }
        
        .meta-section {
            flex: 1;
        }
        
        .meta-section h3 {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #0d9488;
        }
        
        .meta-section p {
            font-size: 14px;
            margin-bottom: 5px;
        }
        
        .meta-section .name {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }
        
        .service-details {
            margin-bottom: 40px;
        }
        
        .service-details h3 {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #0d9488;
        }
        
        .details-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .details-table th {
            background: #f8f9fa;
            padding: 12px 15px;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #666;
            border-bottom: 2px solid #e9ecef;
        }
        
        .details-table td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
        }
        
        .details-table .description {
            color: #666;
            font-size: 13px;
        }
        
        .details-table .amount {
            text-align: right;
            font-weight: 600;
        }
        
        .payments-section {
            margin-bottom: 40px;
        }
        
        .payments-section h3 {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #0d9488;
        }
        
        .payments-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        
        .payments-table th {
            background: #f8f9fa;
            padding: 10px 12px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #666;
            border-bottom: 2px solid #e9ecef;
        }
        
        .payments-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .payments-table .amount {
            text-align: right;
            font-weight: 500;
            color: #10b981;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
        }
        
        .badge-avance {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .badge-paiement {
            background: #d1fae5;
            color: #065f46;
        }
        
        .badge-solde {
            background: #ede9fe;
            color: #5b21b6;
        }
        
        .totals-section {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 40px;
        }
        
        .totals-box {
            width: 300px;
            background: #f8f9fa;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 20px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .total-row:last-child {
            border-bottom: none;
        }
        
        .total-row .label {
            color: #666;
            font-size: 14px;
        }
        
        .total-row .value {
            font-weight: 600;
            font-size: 14px;
        }
        
        .total-row.grand-total {
            background: linear-gradient(135deg, #0d9488, #0891b2);
            color: white;
        }
        
        .total-row.grand-total .label,
        .total-row.grand-total .value {
            color: white;
            font-size: 16px;
        }
        
        .total-row.remaining {
            background: #fef3c7;
        }
        
        .total-row.remaining .value {
            color: #d97706;
        }
        
        .total-row.paid .value {
            color: #10b981;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-initialiser {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .status-en_cours {
            background: #fef3c7;
            color: #d97706;
        }
        
        .status-termine {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-annule {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .invoice-footer {
            background: #f8f9fa;
            padding: 30px 40px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        
        .invoice-footer p {
            font-size: 13px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .invoice-footer .thank-you {
            font-size: 16px;
            font-weight: 600;
            color: #0d9488;
            margin-bottom: 10px;
        }
        
        .no-payments {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }
        
        .print-actions {
            text-align: center;
            padding: 20px;
            background: #f5f5f5;
        }
        
        .print-actions button {
            background: linear-gradient(135deg, #0d9488, #0891b2);
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            margin: 0 10px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .print-actions button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
        }
        
        .print-actions .btn-secondary {
            background: #6b7280;
        }
        
        .print-actions .btn-secondary:hover {
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
        }
        
        @media print {
            body {
                background: white;
            }
            
            .invoice-container {
                box-shadow: none;
                margin: 0;
                max-width: 100%;
            }
            
            .print-actions {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="print-actions">
        <button onclick="window.print()">
            <svg style="width:16px;height:16px;vertical-align:middle;margin-right:8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Imprimer
        </button>
        <button class="btn-secondary" onclick="window.history.back()">
            <svg style="width:16px;height:16px;vertical-align:middle;margin-right:8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour
        </button>
    </div>
    
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="company-info">
                <h1>Abedrhman</h1>
                <p>Services professionnels</p>
            </div>
            <div class="invoice-title">
                <h2>FACTURE</h2>
                <div class="invoice-number">#{{ str_pad($service->id, 6, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>
        
        <div class="invoice-body">
            <div class="invoice-meta">
                <div class="meta-section">
                    <h3>Facturé à</h3>
                    @if($service->client)
                    <p class="name">
                        {{ $service->client->type === 'morale' ? $service->client->nom_raison_sociale : ($service->client->nom . ' ' . $service->client->prenom) }}
                    </p>
                    @if($service->client->type === 'morale' && $service->client->dirigeants->count() > 0)
                    <p>Gérant: {{ $service->client->dirigeants->first()->nom ?? 'N/A' }}</p>
                    @endif
                    @if($service->client->siege_social)
                    <p>{{ $service->client->siege_social }}</p>
                    @endif
                    <p>{{ $service->client->ville ?? '' }}{{ $service->client->pays ? ', ' . $service->client->pays : '' }}</p>
                    @if($service->client->tel_1)
                    <p>Tél: {{ $service->client->tel_1 }}</p>
                    @endif
                    @if($service->client->email)
                    <p>Email: {{ $service->client->email }}</p>
                    @endif
                    @if($service->client->ice)
                    <p>ICE: {{ $service->client->ice }}</p>
                    @endif
                    @else
                    <p class="name">Client non spécifié</p>
                    @endif
                </div>
                
                <div class="meta-section">
                    <h3>Détails de la facture</h3>
                    <p><strong>Date d'émission:</strong> {{ now()->format('d/m/Y') }}</p>
                    <p><strong>Date de création:</strong> {{ $service->created_at->format('d/m/Y') }}</p>
                    <p>
                        <strong>Statut:</strong>
                        <span class="status-badge status-{{ $service->status }}">{{ $service->status_label }}</span>
                    </p>
                </div>
            </div>
            
            <div class="service-details">
                <h3>Détails du service</h3>
                <table class="details-table">
                    <thead>
                        <tr>
                            <th style="width: 60%;">Description</th>
                            <th style="width: 20%;">Type</th>
                            <th style="width: 20%; text-align: right;">Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>{{ $service->typeService->nom ?? 'Service' }}</strong>
                                @if($service->description)
                                <div class="description">{{ $service->description }}</div>
                                @endif
                            </td>
                            <td>{{ $service->typeService->nom ?? 'N/A' }}</td>
                            <td class="amount">{{ $service->formatted_prix }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            @if($service->payments->count() > 0)
            <div class="payments-section">
                <h3>Historique des paiements</h3>
                <table class="payments-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Mode</th>
                            <th>Référence</th>
                            <th style="text-align: right;">Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($service->payments->sortBy('date_paiement') as $payment)
                        <tr>
                            <td>{{ $payment->date_paiement->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge badge-{{ $payment->type }}">{{ $payment->type_label }}</span>
                            </td>
                            <td>{{ $payment->mode_paiement_label }}</td>
                            <td>{{ $payment->reference ?? '-' }}</td>
                            <td class="amount">{{ $payment->formatted_montant }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            
            <div class="totals-section">
                <div class="totals-box">
                    <div class="total-row grand-total">
                        <span class="label">Total</span>
                        <span class="value">{{ $service->formatted_prix }}</span>
                    </div>
                    <div class="total-row paid">
                        <span class="label">Total payé</span>
                        <span class="value">{{ $service->formatted_total_payments }}</span>
                    </div>
                    @if($service->remaining_amount > 0)
                    <div class="total-row remaining">
                        <span class="label">Reste à payer</span>
                        <span class="value">{{ $service->formatted_remaining_amount }}</span>
                    </div>
                    @else
                    <div class="total-row" style="background: #d1fae5;">
                        <span class="label" style="color: #065f46;">✓ Soldé</span>
                        <span class="value" style="color: #065f46;">0,00 DH</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="invoice-footer">
            <p class="thank-you">Merci pour votre confiance !</p>
            <p>Cette facture a été générée automatiquement par le système Abedrhman.</p>
            <p>Date d'impression: {{ now()->format('d/m/Y à H:i') }}</p>
        </div>
    </div>
</body>
</html>

