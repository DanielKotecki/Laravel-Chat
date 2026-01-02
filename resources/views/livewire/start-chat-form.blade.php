<div>
    <div class="min-h-screen bg-base-200 flex items-center justify-center p-4">
        <div class="max-w-5xl w-full bg-base-100 shadow-xl rounded-3xl overflow-hidden flex flex-col lg:flex-row">

            <div class="p-8 lg:w-1/2 flex flex-col justify-center">

                <div class="flex justify-between mb-4">
                    <x-mary-theme-toggle class="btn btn-circle"/>
                    <livewire:locale.set-locale-component/>
                </div>
                <form wire:submit.prevent="submit()">
                    <div class="text-center mb-8">
                        <h2 class="text-4xl font-bold mb-2">{{__('welcome.header.h1')}}</h2>
                        <p class="text-base-content/70 text-lg">{{__('welcome.header.p')}}</p>
                    </div>

                    <div class="mb-5">
                        <label class="label"><span
                                class="label-text font-bold text-xl mb-2">{{__('welcome.form.gender.gender_label')}}</span></label>
                        <div class="grid grid-cols-3 gap-3">
                            <label class="gender-option flex flex-col items-center justify-center py-4 px-2 border-2 rounded-2xl cursor-pointer transition-all hover:bg-base-200
                       has-[:checked]:border-blue-500 has-[:checked]:bg-blue-500/35  {{$errors->has('form.gender')? 'border-red-500':''}}">
                                <input type="radio" name="gender" value="{{\App\Enums\GenderEnum::MALE}}"
                                       wire:model.live="form.gender" class="hidden" checked/>
                                <span class="text-3xl">♂️</span>
                                <span
                                    class="text-sm font-semibold mt-1 {{$errors->has('form.gender')? 'text-red-500':''}}">{{__('welcome.form.gender.gender_options.male')}}</span>
                            </label>

                            <label class="gender-option flex flex-col items-center justify-center py-4 px-2 border-2 rounded-2xl cursor-pointer transition-all hover:bg-base-200
                       has-[:checked]:border-pink-500 has-[:checked]:bg-pink-500/35  {{$errors->has('form.gender')? 'border-red-500':''}}">
                                <input type="radio" name="gender" value="{{\App\Enums\GenderEnum::FEMALE}}"
                                       wire:model.live="form.gender" class="hidden"/>
                                <span class="text-3xl">♀️</span>
                                <span
                                    class="text-sm font-semibold mt-1 {{$errors->has('form.gender')? 'text-red-500':''}}">{{__('welcome.form.gender.gender_options.female')}}</span>
                            </label>

                            <label class="gender-option flex flex-col items-center justify-center py-4 px-2 border-2 rounded-2xl cursor-pointer transition-all hover:bg-base-200
                       has-[:checked]:border-purple-500 has-[:checked]:bg-purple-500/35  {{$errors->has('form.gender')? 'border-red-500':''}}">
                                <input type="radio" name="gender" value="{{\App\Enums\GenderEnum::OTHER}}"
                                       wire:model.live="form.gender" class="hidden"/>
                                <span class="text-3xl">⚧</span>
                                <span
                                    class="text-sm font-semibold mt-1 {{$errors->has('form.gender')? 'text-red-500':''}}">{{__('welcome.form.gender.gender_options.other')}}</span>
                            </label>
                        </div>
                        @error('form.gender')
                        <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="label"><span
                                class="label-text font-bold text-xl mb-2">{{__('welcome.form.age.age_label')}}</span></label>
                        <div class="grid grid-cols-5 gap-2">
                            @foreach($ageRanges as $key => $age)
                                <label class="age-option flex items-center justify-center py-3 border-2 rounded-xl cursor-pointer transition-all hover:bg-base-200
                       has-[:checked]:border-primary has-[:checked]:bg-primary/35  {{$errors->has('form.age')? 'border-red-500':''}}">
                                    <input type="radio" name="age" value="{{$key}}" wire:model.live="form.age"
                                           class="hidden"/>
                                    <span
                                        class="text-sm font-medium {{$errors->has('form.age') ? 'text-red-500':''}}">{{$age}}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('form.age')
                        <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="label"><span
                                class="label-text font-bold text-xl mb-2">{{__('welcome.form.nickname.nickname_label')}}</span></label>
                        <input type="text" id="nickInput" wire:model.live="form.nickname"
                               placeholder="{{__('welcome.form.nickname.nickname_placeholder')}}"
                               class="input input-bordered w-full"/>
                        @error('form.nickname')
                        <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="label"><span
                                class="label-text font-bold text-xl mb-2">{{__('welcome.form.tags.tags_label')}}</span></label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($tags as $key => $tag)
                                <label class=" badge badge-lg badge-outline age-option flex items-center justify-center border-1 rounded-xl cursor-pointer transition-all hover:bg-base-200
                       has-[:checked]:border-primary has-[:checked]:bg-primary/35  {{$errors->has('form.tags')? 'border-red-500':''}}">
                                    <input type="checkbox" name="selectedTags[]" value="{{$key}}"
                                           wire:model.live="form.tags"
                                           class="hidden" {{$this->maxTags($key)}}/>
                                    <span
                                        class=" text-sm font-medium {{$errors->has('form.tags') ? 'text-red-500':''}}">#{{$tag}}</span>
                                </label>
                            @endforeach

                        </div>
                        @error('form.tags')
                        <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                            {{ $message }}
                        </p>
                        @enderror
                        <p class="text-xs text-base-content/60 mt-2">{{__('welcome.form.tags.tags_p')}}</p>
                    </div>

                    <div class="mb-6">
                        <label class="cursor-pointer label flex items-center gap-3">
                            <input type="checkbox"
                                   wire:model.live="form.accept_terms"
                                   class="checkbox checkbox-primary checkbox-md {{$errors->has('form.accept_terms')? 'border-red-500':''}} "/>
                            <span class="label-text">
                                {{ __('welcome.form.accept_terms') }}
                                <a href="{{ route('terms') }}"
                                   target="_blank"
                                   class="link link-primary font-medium">
                                    {{ __('welcome.form.terms_link') }}
                                </a>
                                <span class="text-error ml-1">*</span>
                            </span>
                        </label>

                        @error('form.accept_terms')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>


                    <button id="startBtn" type="submit"
                            class="btn btn-primary btn-block text-xl py-4 h-auto rounded-xl shadow-lg hover:shadow-primary/40 transition-shadow">
                        <i data-lucide="shuffle" class="w-6 h-6 mr-2"></i>
                        {{__('welcome.form.buttons.submit')}}
                    </button>
                </form>
            </div>

            <div class="hidden lg:block lg:w-1/2 bg-blue-50 relative min-h-[600px]">
                <img src="{{asset('chatimage.png')}}"
                     alt="Random Chat Illustration"
                     class="absolute inset-0 w-full h-full object-cover"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>

        </div>
    </div>
</div>
