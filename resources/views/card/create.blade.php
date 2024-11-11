<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Deck') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('deck.card.store', ['deck' => $deck]) }}" class="w-full">
                        @csrf

                        <!-- Query -->
                        <div class="flex flex-col gap-4 mb-6">
                            <x-input-label for="query" :value="__('Query')" />
                            <x-text-input id="query" class="block mt-1 w-full h-9 px-2" type="text" name="query" :value="old('query')" required autofocus />
                            <x-input-error :messages="$errors->get('query')" class="mt-2" />
                        </div>

                        <!-- Answer -->
                        <div class="flex flex-col gap-4 mb-6">
                            <x-input-label for="answer" :value="__('Answer')" />
                            <x-text-input id="answer" class="block mt-1 w-full h-9 px-2" type="text" name="answer" :value="old('answer')" required />
                            <x-input-error :messages="$errors->get('answer')" class="mt-2" />
                        </div>

                        <!-- Difficulty -->
                        <div class="flex flex-col gap-4 mb-6">
                            <x-input-label for="difficulty" :value="__('Difficulty')" />
                            <div class="flex items-center gap-2">
                                <x-text-input id="easy" class="block dark:text-indigo-600" type="radio" name="difficulty" value="{{ App\Enums\CardDifficulty::EASY }}"  required/>
                                <x-input-label for="easy" :value="__('Easy')" />
                                <x-text-input id="medium" class="block dark:text-indigo-600" type="radio" name="difficulty" value="{{ App\Enums\CardDifficulty::MEDIUM }}"  required/>
                                <x-input-label for="medium" :value="__('Medium')" />
                                <x-text-input id="hard" class="block dark:text-indigo-600" type="radio" name="difficulty" value="{{ App\Enums\CardDifficulty::HARD }}"  required/>
                                <x-input-label for="hard" :value="__('Hard')" />
                            </div>
                            <x-input-error :messages="$errors->get('difficulty')" class="mt-2" />
                        </div>

                        <!-- Note -->
                        <div class="flex flex-col gap-4 mb-6">
                            <x-input-label for="name" :value="__('Note')" />
                            <textarea id="note" class="block mt-1 w-full h-9 px-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="note">{{ old('note') }}</textarea>
                            <x-input-error :messages="$errors->get('note')" class="mt-2" />
                        </div>

                        <!-- Answer -->
                        <div class="block mt-4">
                            <label for="add_another" class="inline-flex items-center">
                                <input value="1" id="add_another" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="add_another" @checked(session('add_another'))>
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Add another card') }}</span>
                            </label>
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
