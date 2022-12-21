<x-app-layout>
    <x-slot name="title">{{ __('views.task.pages.index.title') }}</x-slot>
    <x-slot name="header">
        {{ __('views.task.pages.index.title') }}
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between">
                {{ Form::open(['route' => ['tasks.index'], 'method' => 'GET']) }}
                <div class="flex justify-center gap-x-2">
                    <x-select-input-block entity="task" name="filter[status_id]" :items=$statuses label=0 />
                    <x-select-input-block entity="task" name="filter[created_by_id]" :items=$creators label=0 />
                    <x-select-input-block entity="task" name="filter[assigned_to_id]" :items=$execs label=0 />
                    <x-submit entity="task" type="filter" />
                </div>
                {{ Form::close() }}
                @auth
                    <x-primary-button>
                        <a href="{{ route('tasks.create') }}">{{ __('views.task.pages.index.new') }}</a>
                    </x-primary-button>
                @endauth
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xxl">
                    <table class="w-full">
                        <thead class="border-b-2 border-solid border-black text-left">
                            <tr>
                                <th>ID</th>
                                <th>Статус</th>
                                <th>Имя</th>
                                <th>Автор</th>
                                <th>Исполнитель</th>
                                <th>Дата создания</th>
                                @auth
                                    <th>Действия</th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr class="border-b border-dashed text-left">
                                    <td>{{ $task->id }}</td>
                                    <td>{{ $task->status->name }}</td>
                                    <td>
                                        <a class="text-blue-600 hover:text-blue-900"
                                            href="{{ route('tasks.show', ['task' => $task->id]) }}">
                                            {{ $task->name }}
                                        </a>
                                    </td>
                                    <td>{{ $task->creator->name }}</td>
                                    <td>{{ $task->executor->name }}</td>
                                    <td>{{ $task->created_at }}</td>
                                    @auth
                                        <td>
                                            <a data-confirm="Вы уверены?" data-method="delete"
                                                class="text-red-600 hover:text-red-900"
                                                href="{{ route('tasks.destroy', $task->id) }}">
                                                Удалить </a>
                                            <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">Изменить</a>
                                        </td>
                                    @endauth

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
