<x-app-layout>
    <x-slot name="header">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
            ← Retour
        </a>
    </x-slot>

    <div class="container max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <section class="grid items-start gap-8">
            <form class="w-full mx-auto" method="POST" action="{{ route('movies.update', $movie) }}') }}">
                @method('PUT')
                @csrf
                <div class="mb-4">
                    <label for="titre" class="block mb-2 font-medium text-gray-900 dark:text-white">
                        Titre</label>
                    <input type="text" id="titre"
                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="titre"
                        required
                        value="{{ $movie->titre }}"
                        />
                </div>

                <div class="mb-4">
                    <label for="genre" class="block mb-2 font-medium text-gray-900 dark:text-white">
                        Genre</label>
                    <select id="genre"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="genre"
                    >
                        <option disabled>Choose a genre</option>
                        @foreach ($types as $genre)
                            <option value="{{ $genre->id_genre }}" selected="{{ $genre->id_genre == $movie->id_genre ? 'selected' : '' }}">{{ ucfirst($genre->nom) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="distributeur" class="block mb-2 font-medium text-gray-900 dark:text-white">
                        Distributeur</label>
                    <select id="distributeur"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required
                        name="distributeur"
                    >
                        <option disabled>Choose a genre</option>
                        @foreach ($distributors as $distributeur)
                            <option value="{{ $distributeur->id_distributeur }}" selected="{{ $distributeur->id_distributeur == $movie->id_distributeur ? 'selected' : '' }}">{{ ucfirst($distributeur->nom) }} -
                                (Telephone: {{ $distributeur->telephone }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="resum" class="block mb-2 font-medium text-gray-900 dark:text-white">
                        Resum</label>
                    <textarea id="resum" rows="4"
                        name="resum"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >{{ $movie->resum }}</textarea>
                </div>
                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <label for="date_debut_affiche" class="block mb-2 font-medium text-gray-900 dark:text-white">
                            Date debut affiche</label>
                        <input type="date" id="date_debut_affiche"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="date_debut_affiche"
                            value="{{ $movie->date_debut_affiche }}"
                        />
                    </div>
                    <div>
                        <label for="date_fin_affiche" class="block mb-2 font-medium text-gray-900 dark:text-white">
                            Date fin affiche</label>
                        <input type="date" id="date_fin_affiche"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="date_fin_affiche"
                            value="{{ $movie->date_fin_affiche }}"
                        />
                    </div>
                </div>

                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <label for="duree_minutes" class="block mb-2 font-medium text-gray-900 dark:text-white">
                            Duree minutes</label>
                        <input type="number" id="duree_minutes"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="duree_minutes"
                            value="{{ $movie->duree_minutes }}"
                        />
                    </div>
                    <div>
                        <label for="annee_production" class="block mb-2 font-medium text-gray-900 dark:text-white">
                            Annee production</label>
                        <input type="number" id="annee_production"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="annee_production"
                            value="{{ $movie->annee_production }}"
                        />
                    </div>
                </div>

                <div class="mb-5">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Update
                    </button>
                </div>
            </form>
        </section>
    </div>
</x-app-layout>
