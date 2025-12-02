<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture <?php echo e($facture->numero); ?> - Abedrhman</title>
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
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
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
            font-weight: 600;
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
            border-bottom: 2px solid #7c3aed;
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
            border-bottom: 2px solid #7c3aed;
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
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
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
        
        .status-brouillon {
            background: #e5e7eb;
            color: #4b5563;
        }
        
        .status-envoyee {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .status-payee {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-partielle {
            background: #fef3c7;
            color: #d97706;
        }
        
        .status-annulee {
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
            color: #7c3aed;
            margin-bottom: 10px;
        }
        
        .print-actions {
            text-align: center;
            padding: 20px;
            background: #f5f5f5;
        }
        
        .print-actions button {
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
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
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
        }
        
        .print-actions .btn-secondary {
            background: #6b7280;
        }
        
        .print-actions .btn-secondary:hover {
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
        }
        
        .legal-mention {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            font-size: 11px;
            color: #666;
            text-align: center;
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
                <div class="invoice-number"><?php echo e($facture->numero); ?></div>
            </div>
        </div>
        
        <div class="invoice-body">
            <div class="invoice-meta">
                <div class="meta-section">
                    <h3>Facturé à</h3>
                    <?php if($facture->client): ?>
                    <p class="name">
                        <?php echo e($facture->client->type === 'morale' ? $facture->client->nom_raison_sociale : ($facture->client->nom . ' ' . $facture->client->prenom)); ?>

                    </p>
                    <?php if($facture->client->type === 'morale' && $facture->client->dirigeants->count() > 0): ?>
                    <p>Gérant: <?php echo e($facture->client->dirigeants->first()->nom ?? 'N/A'); ?></p>
                    <?php endif; ?>
                    <?php if($facture->client->siege_social): ?>
                    <p><?php echo e($facture->client->siege_social); ?></p>
                    <?php endif; ?>
                    <p><?php echo e($facture->client->ville ?? ''); ?><?php echo e($facture->client->pays ? ', ' . $facture->client->pays : ''); ?></p>
                    <?php if($facture->client->tel_1): ?>
                    <p>Tél: <?php echo e($facture->client->tel_1); ?></p>
                    <?php endif; ?>
                    <?php if($facture->client->ice): ?>
                    <p>ICE: <?php echo e($facture->client->ice); ?></p>
                    <?php endif; ?>
                    <?php else: ?>
                    <p class="name">Client non spécifié</p>
                    <?php endif; ?>
                </div>
                
                <div class="meta-section">
                    <h3>Détails de la facture</h3>
                    <p><strong>N° Facture:</strong> <?php echo e($facture->numero); ?></p>
                    <p><strong>Date d'émission:</strong> <?php echo e($facture->date_facture->format('d/m/Y')); ?></p>
                    <?php if($facture->date_echeance): ?>
                    <p><strong>Date d'échéance:</strong> <?php echo e($facture->date_echeance->format('d/m/Y')); ?></p>
                    <?php endif; ?>
                    <p>
                        <strong>Statut:</strong>
                        <span class="status-badge status-<?php echo e($facture->statut); ?>"><?php echo e($facture->statut_label); ?></span>
                    </p>
                </div>
            </div>
            
            <div class="service-details">
                <h3>Désignation</h3>
                <table class="details-table">
                    <thead>
                        <tr>
                            <th style="width: 70%;">Description</th>
                            <th style="width: 30%; text-align: right;">Montant HT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong><?php echo e($facture->service->typeService->nom ?? 'Service'); ?></strong>
                                <?php if($facture->service->description): ?>
                                <div class="description"><?php echo e($facture->service->description); ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="amount"><?php echo e($facture->formatted_montant_total); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="totals-section">
                <div class="totals-box">
                    <div class="total-row grand-total">
                        <span class="label">Total TTC</span>
                        <span class="value"><?php echo e($facture->formatted_montant_total); ?></span>
                    </div>
                    <div class="total-row paid">
                        <span class="label">Montant payé</span>
                        <span class="value"><?php echo e($facture->formatted_montant_paye); ?></span>
                    </div>
                    <?php if($facture->montant_restant > 0): ?>
                    <div class="total-row remaining">
                        <span class="label">Reste à payer</span>
                        <span class="value"><?php echo e($facture->formatted_montant_restant); ?></span>
                    </div>
                    <?php else: ?>
                    <div class="total-row" style="background: #d1fae5;">
                        <span class="label" style="color: #065f46;">✓ Soldé</span>
                        <span class="value" style="color: #065f46;">0,00 DH</span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="legal-mention">
                <p>TVA non applicable, art. 293 B du CGI</p>
                <p>En cas de retard de paiement, une pénalité de 3 fois le taux d'intérêt légal sera appliquée.</p>
            </div>
        </div>
        
        <div class="invoice-footer">
            <p class="thank-you">Merci pour votre confiance !</p>
            <p>Facture générée le <?php echo e(now()->format('d/m/Y à H:i')); ?></p>
        </div>
    </div>
</body>
</html>

<?php /**PATH C:\Users\Espacegamers\Documents\abedrhman\resources\views/sections/factures-print.blade.php ENDPATH**/ ?>