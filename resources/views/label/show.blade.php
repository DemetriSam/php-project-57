<x-app-layout>
    <x-slot name="title">{{ __('views.label.pages.show.title') }}{{ $label->name }}</x-slot>
    <x-slot name="header">
        {{ __('views.label.pages.show.title') }}{{ $label->name }}
        @auth
            <a href="{{ route('labels.edit', ['label' => $label->id]) }}"><small
                    class="lowercase">({{ __('views.actions.edit') }})</small></a>
        @endauth
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-form-card>
            <p>{{ $label->description }}</p>

        </x-form-card>
    </div>
</x-app-layout>
