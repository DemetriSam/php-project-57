<x-app-layout>
    <x-slot name="title">Задача: {{ $task->name }}</x-slot>
    <x-slot name="header">
        <h1>Задача: {{ $task->name }}</h1>
        @auth
            <a href="{{ route('tasks.edit', ['task' => $task->id]) }}"><small class="">(edit)</small></a>
        @endauth
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-form-card>
            <p>{{ $task->description }}</p>
        </x-form-card>
    </div>
</x-app-layout>
