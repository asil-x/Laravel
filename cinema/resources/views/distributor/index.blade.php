<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Distributors') }}
            </h2>
            <a href="{{ route('distributors.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="container max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <section class="grid items-start gap-8">


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nom
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Telephone
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Vpostal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ville
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pays
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($distributors as $distributeur)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ ucfirst($distributeur->nom) }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $distributeur->telephone }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $distributeur->adresse }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $distributeur->cpostal }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $distributeur->ville }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $distributeur->pays }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('distributors.show', ['distributor' => $distributeur]) }}"
                                        class="font-medium text-gray-600 dark:text-gray-500 hover:underline float-left mr-4">View</a>
                                    <a href="{{ route('distributors.edit', ['distributor' => $distributeur]) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline float-left">Edit</a>

                                    <form action="{{ route('distributors.destroy', ['distributor' => $distributeur]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $distributors->links() }}
        </section>
    </div>
</x-app-layout>
