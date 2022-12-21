<x-app-layout>
    <x-slot name="title">{{ __('views.status.pages.show.title') }}{{ $taskStatus->name }}</x-slot>
    <x-slot name="header">
        {{ __('views.status.pages.show.title') }}{{ $taskStatus->name }}
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @auth
            <a href="{{ route('task_statuses.edit', ['task_status' => $taskStatus->id]) }}">
                <small class="">(edit)</small>
            </a>
        @endauth
    </div>
</x-app-layout>
