<x-app-layout>
    <x-slot name="title">{{ __('views.status.pages.index.title') }}</x-slot>
    <x-slot name="header">
        <div class="flex justify-between gap-x-4 content-baseline">
            <h1 class="text-xl">{{ __('views.status.pages.index.title') }}</h1>
        </div>

    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-form-card>
            @auth
                <x-primary-button>
                    <a href="{{ route('task_statuses.create') }}">{{ __('views.status.pages.index.new') }}</a>
                </x-primary-button>
            @endauth
            <div class="py-5">
                <ul>
                    @foreach ($taskStatuses as $status)
                        <li><a href="{{ route('task_statuses.show', ['task_status' => $status->id]) }}">{{ $status->id }}
                                - {{ $status->name }}</a>
                            @auth
                                <a href="{{ route('task_statuses.edit', ['task_status' => $status->id]) }}"><small
                                        class="">(edit)</small></a>
                            @endauth
                        </li>
                    @endforeach
                </ul>
            </div>
        </x-form-card>
    </div>

</x-app-layout>
