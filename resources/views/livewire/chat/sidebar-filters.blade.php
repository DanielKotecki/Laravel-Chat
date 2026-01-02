<div class="px-3 pt-3">
    <div class="flex justify-center">
        <h2 class="text-2xl font-bold uppercase mb-2">{{__('sidebar_filters.header.title')}}</h2>
    </div>

    {{-- Nagłówek dla sekcji --}}
    <h3 class="text-sm font-semibold uppercase text-base-content/80 mb-2">
        {{__('sidebar_filters.age_section.title')}}
    </h3>

    {{-- Checkbox dla "Active" --}}
    <x-mary-checkbox
        label="{{__('sidebar_filters.gender_section.female')}}"
        wire:model="female"
        class="mb-2"
        icon="o-check-circle"
    />
    <x-mary-checkbox
        label="{{__('sidebar_filters.gender_section.male')}}"
        wire:model="male"
        class="mb-2"
        icon="o-check-circle"
    />
    <x-mary-checkbox
        label="{{__('sidebar_filters.gender_section.other')}}"
        wire:model.live="other"
        class="mb-2"
        icon="o-check-circle"
    />

    {{-- Opcjonalnie: Separator --}}
    <x-mary-menu-separator class="mt-3"/>

    {{-- Opcjonalnie: Przykładowy przełącznik --}}
    <h3 class="text-sm font-semibold uppercase text-base-content/80 mb-2 mt-4 ">
        {{__('sidebar_filters.age_section.title')}}
    </h3>
    <x-mary-select
        wire:model="form.age"
        placeholder="{{__('sidebar_filters.age_section.opt_default')}}"
        :options="$ageRanges"
        class="font-semibold text-sm"
        placeholder-value="all"
    />
    <x-mary-menu-separator class="mt-4"/>

    <div x-data="{ open: false }" class="mt-4 mb-2">

        <h3 @click="open = !open"
            class="text-sm font-semibold uppercase text-base-content/80 cursor-pointer flex justify-between items-center select-none">
            {{__('sidebar_filters.tag_section.title')}}
            <x-mary-icon
                name="o-chevron-down"
                class="w-4 h-4 transform transition duration-300"
                x-bind:class="{ 'rotate-180': open }"
            />
        </h3>

        <div x-show="open" x-collapse>
            <div class="flex flex-wrap gap-2 mt-2">
                @foreach($tags as $key=>$tag)
                    <label class=" badge badge-lg badge-outline age-option flex items-center justify-center border-1 rounded-xl cursor-pointer transition-all hover:bg-base-200
                           has-[:checked]:border-primary has-[:checked]:bg-primary/35 ">
                        <input type="checkbox" name="selectedTags[]" value="{{$key}}"
                               wire:model.live="form.tags"
                               class="hidden"/>
                        <span class=" text-sm font-medium">#{{$tag}}</span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>
    <div class="flex justify-center gap-3 mt-6">

        <x-mary-button
            label="{{__('sidebar_filters.button_section.reset')}}"
            wire:click="resetFilters"
            class="btn-error btn-dash font-bold w-24"
        />

        <x-mary-button
            label="{{__('sidebar_filters.button_section.search')}}"
            class="btn-success font-bold w-24"
            wire:click.debounce="saveFilters"
        />

    </div>
</div>
