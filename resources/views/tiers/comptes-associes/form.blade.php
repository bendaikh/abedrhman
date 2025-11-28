@extends('layouts.app')

@section('title', ($compteAssocie ? 'Modifier' : 'Créer') . ' un compte associé - Abedrhman')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('comptes-associes.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white">
            {{ $compteAssocie ? 'Modifier' : 'Créer' }} un compte associé
        </h2>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6">
        <form action="{{ $compteAssocie ? route('comptes-associes.update', $compteAssocie->id) : route('comptes-associes.store') }}" method="POST">
            @csrf
            @if($compteAssocie)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nom_prenom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nom & Prénom</label>
                    <input type="text" id="nom_prenom" name="nom_prenom" value="{{ old('nom_prenom', $compteAssocie->nom_prenom ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="tel" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Téléphone</label>
                    <input type="text" id="tel" name="tel" value="{{ old('tel', $compteAssocie->tel ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $compteAssocie->email ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="rib" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">RIB</label>
                    <input type="text" id="rib" name="rib" value="{{ old('rib', $compteAssocie->rib ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('comptes-associes.index') }}" class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    {{ $compteAssocie ? 'Mettre à jour' : 'Créer' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

