<x-app-layout>
    <x-slot name="header">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
            ← Retour
        </a>
    </x-slot>

    <div class="container max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <section class="grid items-start gap-8">
            <form class="w-full mx-auto" method="POST" action="{{ route('distributors.update', $distributor) }}') }}">
                @method('PUT')
                @csrf
                <div class="mb-4">
                    <label for="nom" class="block mb-2 font-medium text-gray-900">
                        Nom</label>
                    <input type="text" id="nom"
                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="nom"
                        value="{{ $distributor->nom }}"
                        required />
                </div>

                <div class="mb-4">
                    <label for="telephone" class="block mb-2 font-medium text-gray-900">
                        Telephone</label>
                    <input type="text" id="telephone"
                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="telephone"
                        value="{{ $distributor->telephone }}"
                        required />
                </div>

                <div class="mb-4">
                    <label for="adresse" class="block mb-2 font-medium text-gray-900">
                        Adresse</label>
                    <input type="text" id="adresse"
                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="adresse"
                        value="{{ $distributor->adresse }}"
                        />
                </div>

                <div class="mb-4">
                    <label for="cpostal" class="block mb-2 font-medium text-gray-900">
                        Cpostal</label>
                    <input type="text" id="cpostal"
                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="cpostal"
                        value="{{ $distributor->cpostal }}"
                        />
                </div>

                <div class="mb-4">
                    <label for="ville" class="block mb-2 font-medium text-gray-900">
                        Ville</label>
                    <input type="text" id="ville"
                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="ville"
                        value="{{ $distributor->ville }}"
                        />
                </div>

                <div class="mb-4">
                    <label for="pays" class="block mb-2 font-medium text-gray-900">
                        Pays</label>
                    <input type="text" id="pays"
                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="pays"
                        value="{{ $distributor->pays }}"
                        />
                </div>

                <div class="mb-5 text-center">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center">Update</button>
                </div>
            </form>
        </section>
    </div>
</x-app-layout>
