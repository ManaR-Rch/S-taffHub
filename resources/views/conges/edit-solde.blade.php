@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('conges.admin-solde') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Modifier le solde de congé</h1>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Employé</h2>
                <p class="text-gray-600">{{ $solde->user->name }}</p>
                <p class="text-gray-500 text-sm">{{ $solde->user->email }}</p>
            </div>
        </div>

        <form action="{{ route('conges.update-solde', $solde) }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="solde_annuel" class="block text-sm font-medium text-gray-700">Congés annuels</label>
                    <input type="number" name="solde_annuel" id="solde_annuel" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           value="{{ old('solde_annuel', $solde->solde_annuel) }}" min="0" required>
                </div>

                <div>
                    <label for="solde_exceptionnel" class="block text-sm font-medium text-gray-700">Congés exceptionnels</label>
                    <input type="number" name="solde_exceptionnel" id="solde_exceptionnel" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           value="{{ old('solde_exceptionnel', $solde->solde_exceptionnel) }}" min="0" required>
                </div>

                <div>
                    <label for="solde_maladie" class="block text-sm font-medium text-gray-700">Congés maladie</label>
                    <input type="number" name="solde_maladie" id="solde_maladie" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           value="{{ old('solde_maladie', $solde->solde_maladie) }}" min="0" required>
                </div>

                <div>
                    <label for="commentaire" class="block text-sm font-medium text-gray-700">Commentaire (optionnel)</label>
                    <textarea name="commentaire" id="commentaire" rows="3" 
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('commentaire', $solde->commentaire) }}</textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                    Mettre à jour le solde
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 