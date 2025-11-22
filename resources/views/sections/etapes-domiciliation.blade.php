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
<div class="space-y-6 sm:space-y-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow p-4 sm:p-6 border border-gray-100 dark:border-gray-700">
        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-3 sm:mb-4">Étapes service domiciliation</h3>
        <ol class="space-y-3 sm:space-y-4">
            @foreach ($domiciliationSteps as $step)
                <li class="flex items-start">
                    <span class="flex-shrink-0 h-7 w-7 sm:h-8 sm:w-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold mr-3 sm:mr-4 text-sm sm:text-base">
                        {{ $step['index'] }}
                    </span>
                    <div class="pt-1">
                        <p class="text-xs sm:text-sm font-medium text-gray-900 dark:text-gray-100">{{ $step['title'] }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5">{{ $step['text'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</div>
@endsection

