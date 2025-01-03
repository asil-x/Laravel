<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages
        </h2>
    </x-slot>

    <div class="container max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <section class="grid grid-cols-2 gap-8">
            <div class="p-4">
                @foreach ($toto as $message)
                    <div class="bg-white p-4 rounded-lg border border-gray-300 shadow-md mb-4">
                        <p>{{ $message->content }}</p>
                        @if ($message->user !== null)
                            <p>{{ $message->user->name }}</p>
                        @endif
                        <div class="flex gap-1 flex-wrap">
                            @foreach ($message->tags as $tag)
                                <span style="--bg-color: {{ $tag->color_hex }}"
                                    class="bg-[var(--bg-color)] px-2 py-0.5 rounded-full">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>

                        @if ($message->user_id === auth()->id())
                            <a href="{{ route('messages.edit', ['message' => $message->id]) }}" class="text-blue-600">🖊️ Modifier</a>
                            <form action="{{ route('messages.destroy', ['message' => $message]) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-red-600">🗑️ Supprimer</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="p-4">
                <form class="w-full mx-auto" method="POST" action="{{ route('messages.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="content" class="block mb-2 font-medium text-gray-900">
                            {{ __('Message') }}</label>
                        <input type="text" id="content"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            name="content" required />
                    </div>
                    <div class="mb-4">
                        <label for="tags" class="block mb-2 text-sm font-medium text-gray-900">
                            {{ __('Tags') }}
                        </label>
                        <select name="tags[]" id="tags" multiple
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center">
                            Envoyer
                        </button>
                    </div>
                </form>

            </div>
        </section>
    </div>
</x-app-layout>
