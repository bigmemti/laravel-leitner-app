<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Deck') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex mb-12">
                        <a href="{{ route('deck.create') }}" class="py-2 px-4 rounded-lg bg-green-900">
                            create a new deck <i class="fa-duotone fa-solid fa-plus text-xs fa-beat-fade"></i>
                        </a>
                    </div>
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="border">
                                    #{{ __('id') }}
                                </th>
                                <th class="border">
                                    {{ __('name') }}
                                </th>
                                <th class="border">
                                    {{ __('card counts') }}
                                </th>
                                <th class="border">
                                    {{ __('status') }}
                                </th>
                                <th class="border">
                                    {{ __('reviewable counts') }}
                                </th>
                                <th class="border">
                                    {{ __('actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($decks as $deck)
                                <tr>
                                    <td class="text-center border">{{ $deck->id }}</td>
                                    <td class="text-center border">{{ $deck->name }}</td>
                                    <td class="text-center border">{{ $deck->cards()->count() }}</td>
                                    <td class="text-center border">{{ implode('-', $deck->status()->toArray()) }}</td>
                                    <td class="text-center border">{{ $deck->countReviewableCards() }}</td>
                                    <td class="text-center border">
                                        <div class="flex gap-x-2 justify-center">
                                            <a href="{{ route('deck.show', $deck) }}" class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                                {{ __('Show') }}
                                            </a>
                                            <a href="{{ route('deck.edit', $deck) }}" class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                                {{ __('Edit') }}
                                            </a>
                                            <a href="{{ route('deck.review', $deck) }}" class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                                {{ __('Review') }}
                                            </a>
                                            <form action="{{ route('deck.destroy', $deck) }}" method="POST" class="inline-flex gap-x-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm font-medium text-red-500 dark:text-red-400 hover:text-red-700">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
