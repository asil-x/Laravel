<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Tag') }}
        </h2>
    </x-slot>

    <div class="container max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <section class="grid items-start gap-8">
            <form class="w-full mx-auto" method="POST" action="{{ route('tags.update', $tag) }}">
                @method('PUT')
                @csrf
                <div class="mb-4">
                    <label for="name" class="block mb-2 font-medium text-gray-900">
                        {{ __('Name') }}</label>
                    <input type="text" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ $tag->name }}"
                        name="name" required />
                </div>
                <div class="mb-4">
                    <label for="color" class="block mb-2 font-medium text-gray-900">
                        {{ __('Color') }}</label>
                    <input type="color" id="color" name="color_hex" required value="{{ $tag->color_hex }}" />
                </div>
                <div class="mb-5">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center">Update Tag</button>
                </div>
            </form>
        </section>
    </div>
</x-app-layout>
