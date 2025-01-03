<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tags') }}
            </h2>
            <a href="{{ route('tags.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Add New
            </a>
        </div>

    </x-slot>

    <div class="container max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <section class="grid items-start gap-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Name') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Color')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Message count') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr
                                class="bg-white border-b hover:bg-gray-50">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ ucfirst($tag->name) }}
                                </th>
                                <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    <div style="--tag-color: {{ $tag->color_hex }}"
                                        class="size-6 rounded-full bg-[var(--tag-color)]"></div>
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $tag->messages_count }}
                                </th>

                                <td class="px-6 py-4 flex justify-end">
                                    <a href="{{ route('tags.edit', ['tag' => $tag]) }}"
                                        class="font-medium text-blue-600 hover:underline float-left mr-4">Edit</a>
                                    <form action="{{ route('tags.destroy', ['tag' => $tag]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="float-left font-medium text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $tags->links() }}
        </section>
    </div>
</x-app-layout>
