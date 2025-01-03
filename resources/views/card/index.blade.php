<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex gap-4">
                        <h2>{{ __('Deck') }} :</h2>
                        <span>{{ $deck->name }}</span>
                    </div>
                    <div class="flex mb-12">
                        <a href="{{ route('deck.card.create', ['deck' => $deck]) }}" class="py-2 px-4 rounded-lg bg-green-900">
                            create a new crad <i class="fa-duotone fa-solid fa-plus text-xs fa-beat-fade"></i>
                        </a>
                    </div>
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="border">
                                    #
                                </th>
                                <th class="border">
                                    {{ __('query') }}
                                </th>
                                <th class="border">
                                    {{ __('actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cards as $card)
                                <tr>
                                    <td class="text-center border">{{ $loop->iteration }}</td> 
                                    <td
                                        @class(['text-center border',
                                            'text-green-500'=> $card->difficulty == App\Enums\CardDifficulty::EASY,
                                            'text-yellow-500' => $card->difficulty == App\Enums\CardDifficulty::MEDIUM,
                                            'text-red-500'=> $card->difficulty == App\Enums\CardDifficulty::HARD])
                                    >
                                        {{ $card->query }}
                                    </td>
                                    <td class="text-center border">
                                        <div class="flex gap-x-2 justify-center">
                                            <a href="{{ route('card.show', $card) }}" class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                                {{ __('Show') }}
                                            </a>
                                            <a href="{{ route('card.edit', $card) }}" class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                                {{ __('Edit') }}
                                            </a>
                                            <form action="{{ route('card.destroy', $card) }}" method="POST" class="inline-flex gap-x-1">
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
