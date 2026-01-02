<div>
    <div class="flex items-center gap-5 w-full lg:w-auto">
            <div class="ml-3">
                <div class="flex items-center gap-3 mt-1">

                    @if(($user->tempChat->gender ?? \App\Enums\GenderEnum::OTHER->value) == \App\Enums\GenderEnum::MALE->value)
                        <label class="badge badge-lg badge-outline age-option flex items-center justify-center border-1 rounded-xl cursor-pointer transition-all border-blue-500 bg-blue-500/35">
                            <span class="text-sm font-medium">{{ __('chat.header.gender.male') }}</span>
                        </label>
                    @elseif(($user->tempChat->gender ?? \App\Enums\GenderEnum::OTHER->value) == \App\Enums\GenderEnum::FEMALE->value)
                        <label class="badge badge-lg badge-outline age-option flex items-center justify-center border-1 rounded-xl cursor-pointer transition-all border-pink-500 bg-pink-500/35">
                            <span class="text-sm font-medium">{{ __('chat.header.gender.female') }}</span>
                        </label>
                    @else
                        <label class="badge badge-lg badge-outline age-option flex items-center justify-center border-1 rounded-xl cursor-pointer transition-all border-gray-500 bg-gray-500/35">
                            <span class="text-sm font-medium">{{ __('chat.header.gender.other') }}</span>
                        </label>
                    @endif

                    <label class="badge badge-lg badge-outline age-option flex items-center justify-center border-1 rounded-xl cursor-pointer transition-all border-yellow-500 bg-yellow-500/35">
                        <span class="text-sm font-medium">{{ __('chat.header.age') . ': ' . ($user->tempChat->age->age_range ?? '---') }}</span>
                    </label>
                </div>

                <div class="flex flex-wrap gap-2 mt-2">
                    @foreach($user->tags ?? [] as $tag)
                        <label class="badge badge-lg badge-outline age-option flex items-center justify-center border-1 rounded-xl cursor-pointer transition-all border-primary bg-primary/35">
                            <span class="text-sm font-medium">#{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

    </div>

</div>
