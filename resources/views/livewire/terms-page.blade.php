{{-- resources/views/terms.blade.php --}}

<div class="container mx-auto px-4 py-10 max-w-4xl">
    <x-mary-card class="shadow-xl">
        <h1 class="text-3xl font-bold text-center mb-8">{{ __('terms.title') }}</h1>

        <div class="prose prose-lg max-w-none text-base-content/80">
            <p class="text-sm text-right mb-8">{{ __('terms.last_updated') }}</p>

            <h2>{{ __('terms.section1_title') }}</h2>
            <p>{{ __('terms.section1_content') }}</p>

            <h2>{{ __('terms.section2_title') }}</h2>
            <p>{{ __('terms.section2_content') }}</p>

            <h2>{{ __('terms.section3_title') }}</h2>
            <p>{{ __('terms.section3_content') }}</p>

            <h2>{{ __('terms.section4_title') }}</h2>
            <p>{{ __('terms.section4_content') }}</p>

            <h2>{{ __('terms.section5_title') }}</h2>
            <p>{{ __('terms.section5_content') }}</p>

            <h2>{{ __('terms.section6_title') }}</h2>
            <p>{{ __('terms.section6_content') }}</p>

            <h2>{{ __('terms.section7_title') }}</h2>
            <p>{{ __('terms.section7_content') }}</p>
        </div>

        <div class="flex justify-center mt-12">
            <x-mary-button link="{{ url()->previous() }}" class="btn-primary btn-lg">
                {{ __('terms.back') }}
            </x-mary-button>
        </div>
    </x-mary-card>
</div>
