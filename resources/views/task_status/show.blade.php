<x-app-layout>
    <x-slot name="title">Статус: {{ $taskStatus->name }}</x-slot>
    <x-slot name="header">
        <h1>Статус: {{ $taskStatus->name }}</h1>
        @auth
            <a href="{{ route('task_statuses.edit', ['task_status' => $taskStatus->id]) }}"><small
                    class="">(edit)</small></a>
        @endauth
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    </div>
</x-app-layout>