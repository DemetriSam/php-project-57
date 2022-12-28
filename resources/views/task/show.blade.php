<x-app-layout>
    <x-slot name="title">{{ __('views.task.pages.show.title') }}{{ $task->name }}</x-slot>
    <x-slot name="header">
        {{ __('views.task.pages.show.title') }}{{ $task->name }}
        @auth
            <a href="{{ route('tasks.edit', ['task' => $task->id]) }}"><small class="">(edit)</small></a>
        @endauth
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-form-card>
            <p>{{ $task->description }}</p>
            <p>Статус: {{ $task->status->name }}</p>
            <div class="flex gap-2 mt-2">
                @foreach ($labels as $label)
                    <div class="bg-gray-400 white-color text-white px-3 py-0.5 rounded font-semibold">
                        <small>{{ $label->name }}</small>
                    </div>
                @endforeach
            </div>
        </x-form-card>
    </div>
</x-app-layout>
