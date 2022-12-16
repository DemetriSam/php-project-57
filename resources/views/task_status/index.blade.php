<x-app-layout>
    <x-slot name="title">Список статусов задач</x-slot>
    <x-slot name="header">
        <h1>Список статусов задач</h1>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ul>
            @foreach ($taskStatuses as $status)
                <li><a href="{{ route('task_statuses.show', ['task_status' => $status->id]) }}">{{ $status->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
