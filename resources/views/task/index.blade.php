<x-app-layout>
    <x-slot name="title">Задачи</x-slot>
    <x-slot name="header">
        <div class="flex justify-between gap-x-4 content-baseline">
            <h1 class="text-xl">Задачи</h1>
        </div>

    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-form-card>
            @auth
                <x-primary-button>
                    <a href="{{ route('tasks.create') }}">Создать новую задачу</a>
                </x-primary-button>
            @endauth
            <div class="py-5">
                <ul>
                    @foreach ($tasks as $task)
                        <li><a
                                href="{{ route('tasks.show', ['task' => $task->id]) }}"><span></span>{{ $task->name }}</a>
                            @auth
                                <a href="{{ route('tasks.edit', ['task' => $task->id]) }}"><small
                                        class="">(edit)</small></a>
                            @endauth
                        </li>
                    @endforeach
                </ul>
            </div>
        </x-form-card>
    </div>

</x-app-layout>
