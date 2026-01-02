<div class="card bg-base-100 shadow-xl border border-base-200 rounded-2xl overflow-hidden">
    <div class="card-body p-6 flex flex-row items-center justify-between">
        <!-- Lewa część – dane użytkownika lub skeleton -->
        <div class="flex items-center gap-5 w-full lg:w-auto">
            @if($displayHeader)
                <div>
                    <h1 class="text-2xl font-bold">{{ $headerUser->name ?? 'Użytkownik' }}</h1>
                    <div class="flex items-center gap-3 mt-1">
                        @if(($headerUser->tempChat->gender ?? \App\Enums\GenderEnum::OTHER->value) == \App\Enums\GenderEnum::MALE->value)
                            <label class="badge badge-lg badge-outline age-option flex items-center justify-center border-1 rounded-xl cursor-pointer transition-all border-blue-500 bg-blue-500/35">
                                <span class="text-sm font-medium">{{ __('chat.header.gender.male') }}</span>
                            </label>
                        @elseif(($headerUser->tempChat->gender ?? \App\Enums\GenderEnum::OTHER->value) == \App\Enums\GenderEnum::FEMALE->value)
                            <label class="badge badge-lg badge-outline age-option flex items-center justify-center border-1 rounded-xl cursor-pointer transition-all border-pink-500 bg-pink-500/35">
                                <span class="text-sm font-medium">{{ __('chat.header.gender.female') }}</span>
                            </label>
                        @else
                            <label class="badge badge-lg badge-outline age-option flex items-center justify-center border-1 rounded-xl cursor-pointer transition-all border-gray-500 bg-gray-500/35">
                                <span class="text-sm font-medium">{{ __('chat.header.gender.other') }}</span>
                            </label>
                        @endif

                        <label class="badge badge-lg badge-outline age-option flex items-center justify-center border-1 rounded-xl cursor-pointer transition-all border-yellow-500 bg-yellow-500/35">
                            <span class="text-sm font-medium">{{ __('chat.header.age') . ': ' . ($headerUser->tempChat->age->age_range ?? '---') }}</span>
                        </label>
                    </div>

                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach($headerUser->tags ?? [] as $tag)
                            <label class="badge badge-lg badge-outline age-option flex items-center justify-center border-1 rounded-xl cursor-pointer transition-all border-primary bg-primary/35">
                                <span class="text-sm font-medium">#{{ $tag->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Skeleton tylko po lewej – przyciski zostają prawdziwe -->
                <div class="flex-grow">
                    <div class="skeleton h-8 w-48 mb-2"></div>
                    <div class="flex items-center gap-3 mt-1">
                        <div class="skeleton h-6 w-24 rounded-xl"></div>
                        <div class="skeleton h-6 w-32 rounded-xl"></div>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <div class="skeleton h-6 w-20 rounded-xl"></div>
                        <div class="skeleton h-6 w-24 rounded-xl"></div>
                        <div class="skeleton h-6 w-16 rounded-xl"></div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Prawa część – ZAWSZE prawdziwe przyciski (nawet podczas szukania!) -->
        <div class="flex items-center gap-3 shrink-0">
            @if($headerUser)
            <x-mary-button
                label="{{ __('chat.header.button.disconnect') }}"
                class="btn-error btn-md"
                wire:click="disconnect"
            />@else
                <x-mary-button
                    label="{{ __('chat.header.button.next-person') }}"
                    class="btn-primary btn-md"
                    wire:click="nextPerson"
                />
            @endif

        </div>

    </div>
</div>
