@extends('layouts.app')

@section('title', 'Étapes domiciliation - Abedrhman')

@section('content')
@php
    $domiciliationSteps = [
        ['index' => 1, 'title' => 'Demande', 'text' => 'Collecte de la demande et des pièces annexes'],
        ['index' => 2, 'title' => 'Signature contrat', 'text' => 'Validation des clauses et paraphe du contrat'],
        ['index' => 3, 'title' => 'Signat', 'text' => 'Apposition des signatures complémentaires (clients / partenaires)'],
        ['index' => 4, 'title' => 'Validation', 'text' => 'Contrôle final et mise à disposition du service']
    ];
@endphp
<div class="space-y-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Étapes service domiciliation</h3>
        <ol class="space-y-4">
            @foreach ($domiciliationSteps as $step)
                <li class="flex items-start">
                    <span class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold mr-4">
                        {{ $step['index'] }}
                    </span>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $step['title'] }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ $step['text'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</div>
@endsection

