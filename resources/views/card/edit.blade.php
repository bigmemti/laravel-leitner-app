<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit card') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('card.update', ['card' => $card]) }}" class="w-full">
                        @csrf
                        @method('PATCH')

                        <!-- Query -->
                        <div class="flex flex-col gap-4 mb-6">
                            <x-input-label for="query" :value="__('Query')" />
                            <x-text-input id="query" class="block mt-1 w-full h-9 px-2" type="text" name="query" :value="old('query', $card->query)" required autofocus />
                            <x-input-error :messages="$errors->get('query')" class="mt-2" />
                        </div>

                        <!-- Answer -->
                        <div class="flex flex-col gap-4 mb-6">
                            <x-input-label for="answer" :value="__('Answer')" />
                            <x-text-input id="answer" class="block mt-1 w-full h-9 px-2" type="text" name="answer" :value="old('answer', $card->answer)" required />
                            <x-input-error :messages="$errors->get('answer')" class="mt-2" />
                        </div>

                        <!-- Difficulty -->
                        <div class="flex flex-col gap-4 mb-6">
                            <x-input-label for="difficulty" :value="__('Difficulty')" />
                            <div class="flex items-center gap-2">
                                <x-text-input id="easy" class="block dark:text-gray-900" type="radio" name="difficulty" value="{{ App\Enums\CardDifficulty::EASY }}" :checked="$card->difficulty == App\Enums\CardDifficulty::EASY" required/>
                                <x-input-label for="easy" :value="__('Easy')" />
                                <x-text-input id="medium" class="block dark:text-gray-900" type="radio" name="difficulty" value="{{ App\Enums\CardDifficulty::MEDIUM }}" :checked="$card->difficulty == App\Enums\CardDifficulty::MEDIUM" required/>
                                <x-input-label for="medium" :value="__('Medium')" />
                                <x-text-input id="hard" class="block dark:text-gray-900" type="radio" name="difficulty" value="{{ App\Enums\CardDifficulty::HARD }}" :checked="$card->difficulty == App\Enums\CardDifficulty::HARD" required/>
                                <x-input-label for="hard" :value="__('Hard')" />
                            </div>
                            <x-input-error :messages="$errors->get('difficulty')" class="mt-2" />
                        </div>

                        <!-- Note -->
                        <div class="flex flex-col gap-4 mb-6">
                            <x-input-label for="name" :value="__('Note')" />
                            <textarea id="note" class="block mt-1 w-full h-9 px-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="note">{{ old('note', $card->note) }}</textarea>
                            <x-input-error :messages="$errors->get('note')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-primary-button class="ms-3">
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
