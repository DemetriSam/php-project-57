<x-app-layout>
    <x-slot name="title">{{ __('views.label.pages.index.title') }}</x-slot>
    <x-slot name="header">
        {{ __('views.label.pages.index.title') }}
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-form-card>
            @auth
                <x-primary-button>
                    <a href="{{ route('labels.create') }}">{{ __('views.label.pages.index.new') }}</a>
                </x-primary-button>
            @endauth
            <div class="py-5">
                <ul>
                    @foreach ($labels as $label)
                        <li><a
                                href="{{ route('labels.show', ['label' => $label->id]) }}"><span></span>{{ $label->name }}</a>
                            @auth
                                <a href="{{ route('labels.edit', ['label' => $label->id]) }}"><small
                                        class="">(edit)</small></a>
                            @endauth
                        </li>
                    @endforeach
                </ul>
            </div>
        </x-form-card>
    </div>

</x-app-layout>
