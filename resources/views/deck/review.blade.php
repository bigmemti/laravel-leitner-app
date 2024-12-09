<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Deck') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center gap-4" x-data="{ open : false, time : 0, timer : null, startTimer() {this.time = 0; if (!this.timer) { this.timer = setInterval(() => { this.time++;}, 1000)}}, stopTimer() {clearInterval(this.timer)}}" x-init="startTimer()">
                    @if ($card)
                        <div  class="text-center w-80 rounded-xl py-1.5"> <span x-text="time"></span> {{ __('seconds') }} </div>
                        <div class="w-80 dark:bg-gray-900 p-4 flex flex-col items-center rounded-xl">
                            <div class="text-xs mb-4 -mt-4 dark:bg-gray-800 p-2 rounded-b-lg">
                                palce: box {{ $card->place }}
                            </div>
                            <div>
                                {{ __('Query') }}:
                            </div>
                            <div>
                                {{ $card->query }}
                                <p x-show="!open" class="text-xs text-gray-100 text-center my-2">{{ $card->note }}</p>
                            </div>
                            <template x-if="open">
                                <div class="flex flex-col items-center">
                                    <div>
                                        {{ __('Answer') }}:
                                    </div>
                                    <div class="text-center">
                                        {{ $card->answer }}
                                    </div>
                                </div>
                            </template>
                            <div class="text-xs -mb-4 mt-4 dark:bg-gray-800 p-2 rounded-t-lg flex gap-4">
                                <span class="text-green-500">{{ _('success') }} : {{ $card->success_reviews }}</span>
                                <span>{{ _('difficulty') }} : @if ($card->difficulty == App\Enums\CardDifficulty::EASY)
                                    {{ __('Eazy') }}
                                @elseif($card->difficulty == App\Enums\CardDifficulty::MEDIUM)
                                    {{ __('Medium') }}
                                @elseif($card->difficulty == App\Enums\CardDifficulty::HARD)
                                    {{ __('Hard') }}
                                @endif</span>
                                <span class="text-red-500">{{ __('failed') }} : {{ $card->failed_reviews }}</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="py-2 px-6 rounded-lg my-4 dark:bg-gray-900" x-show='!open' @click="open = true; stopTimer()">{{ __('Show Answer') }}</button>
                            <form x-show="open" action="{{ route('card.review', ['card' => $card]) }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <!-- Status -->
                                <div class="flex flex-col gap-4 mb-6">
                                    <x-input-label for="status" :value="__('Status')" />
                                    <div class="flex items-center gap-2">
                                        <x-text-input id="success" class="block dark:text-gray-900" type="radio" name="status" value="success"  required/>
                                        <x-input-label for="success" :value="__('Success')" />
                                        <x-text-input id="failed" class="block dark:text-gray-900" type="radio" name="status" value="failed"  required/>
                                        <x-input-label for="failed" :value="__('Failed')" />
                                    </div>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
                                <x-primary-button class="ms-3">
                                    {{ __('Next') }}
                                </x-primary-button>
                            </form>
                        </div>
                    @else
                        {{ __('Not card exists for review.') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
