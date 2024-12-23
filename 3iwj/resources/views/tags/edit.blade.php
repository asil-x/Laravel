<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tag') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('tags.update', ['tag' => $tag]) }}" class="p-6 space-y-2">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="name">Name</x-input-label>
                        <x-text-input id="name" name="name" value="{{ $tag->name }}" />
                    </div>
                    <div>
                        <x-input-label for="color">Color</x-input-label>
                        <input type="color" id="color" name="color_hex" value="{{ $tag->color_hex }}" />
                    </div>

                    <x-primary-button>Edit Tag</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>