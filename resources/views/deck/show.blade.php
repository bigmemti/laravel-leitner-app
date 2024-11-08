<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Show Deck') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex gap-4">
                        <h2>{{ __('Name') }} :</h2>
                        <span>{{ $deck->name }}</span>
                    </div>
                    <div class="flex gap-4">
                        <h2>{{ __('Description') }} :</h2>
                        <span>{{ $deck->description }}</span>
                    </div>
                    <div>
                        <a href="{{ route('deck.edit', ['deck' => $deck]) }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                            {{ __('Edit') }}
                        </a>
                    </div>
                    <div>
                        <form action="{{ route('deck.destroy', $deck) }}" method="POST" class="inline-flex gap-x-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm font-medium text-red-500 dark:text-red-400 hover:text-red-700">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                    <div>
                        <a href="{{ route('deck.card.index', ['deck' => $deck]) }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                            {{ __('Cards') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
