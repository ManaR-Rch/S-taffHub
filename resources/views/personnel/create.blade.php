@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Ajouter un membre du personnel</h1>
            <a href="{{ route('personnel.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 ease-in-out flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                </svg>
                Retour à la liste
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Erreurs de validation :</p>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('personnel.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200">
                </div>

                <div>
                    <label for="prenom" class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200">
                </div>

                <div>
                    <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                    <input type="tel" name="telephone" id="telephone" value="{{ old('telephone') }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200">
                </div>

                <div>
                    <label for="poste" class="block text-sm font-medium text-gray-700 mb-2">Poste</label>
                    <input type="text" name="poste" id="poste" value="{{ old('poste') }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200">
                </div>

                <div>
                    <label for="departement" class="block text-sm font-medium text-gray-700 mb-2">Département</label>
                    <input type="text" name="departement" id="departement" value="{{ old('departement') }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200">
                </div>

                <div>
                    <label for="salaire_base" class="block text-sm font-medium text-gray-700 mb-2">Salaire de base</label>
                    <input type="number" name="salaire_base" id="salaire_base" value="{{ old('salaire_base') }}" required step="0.01" min="0"
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200">
                </div>

                <div>
                    <label for="date_embauche" class="block text-sm font-medium text-gray-700 mb-2">Date d'embauche</label>
                    <input type="date" name="date_embauche" id="date_embauche" value="{{ old('date_embauche') }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200">
                </div>

                <div>
                    <label for="statut" class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                    <select name="statut" id="statut" required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200">
                        <option value="actif" {{ old('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                        <option value="inactif" {{ old('statut') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-300 ease-in-out flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
</script>

<style>
.scale-105 {
    transform: scale(1.05);
    transition: transform 0.2s ease-in-out;
}
</style>
@endsection 