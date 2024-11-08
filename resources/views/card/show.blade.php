<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Show Card') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex gap-4">
                        <h2>{{ __('Deck') }} :</h2>
                        <a href="{{ route('deck.show', ['deck' => $card->deck]) }}">{{ $card->deck->name }}</a>
                    </div>
                    <div class="flex gap-4">
                        <h2>{{ __('Query') }} :</h2>
                        <span>{{ $card->query }}</span>
                    </div>
                    <div class="flex gap-4" x-data="{ open: false }">
                        <h2>{{ __('Answer') }} :</h2>
                        <span x-show="open">{{ $card->answer }}</span>
                        <span x-show="!open" @click="open = true" class="cursor-pointer">**************</span>
                    </div>
                    <div class="flex gap-4">
                        <h2>{{ __('Difficulty') }} :</h2>
                        <span
                            @class([ 'text-green-500'=> $card->difficulty == App\Enums\CardDifficulty::EASY,
                                'text-yellow-500' => $card->difficulty == App\Enums\CardDifficulty::MEDIUM,
                                'text-red-500'=> $card->difficulty == App\Enums\CardDifficulty::HARD])
                        >
                            @if ($card->difficulty == App\Enums\CardDifficulty::EASY)
                                {{ __('Eazy') }}
                            @elseif($card->difficulty == App\Enums\CardDifficulty::MEDIUM)
                                {{ __('Medium') }}
                            @elseif($card->difficulty == App\Enums\CardDifficulty::HARD)
                                {{ __('Hard') }}
                            @endif
                        </span>
                    </div>
                    <div class="flex gap-4">
                        <h2>{{ __('Note') }} :</h2>
                        <span>{{ $card->note }}</span>
                    </div>
                    <div>
                        <a href="{{ route('card.edit', ['card' => $card]) }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                            {{ __('Edit') }}
                        </a>
                    </div>
                    <div>
                        <form action="{{ route('card.destroy', $card) }}" method="POST" class="inline-flex gap-x-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm font-medium text-red-500 dark:text-red-400 hover:text-red-700">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
