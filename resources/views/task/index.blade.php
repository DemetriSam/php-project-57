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
                    <x-submit entity="task" type="filter" class="flex flex-col justify-end" />
                </div>
                {{ Form::close() }}
                @auth
                    <a href="{{ route('tasks.create') }}">
                        <x-primary-button>
                            {{ __('views.task.pages.index.new') }}
                        </x-primary-button>
                    </a>
                @endauth
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xxl">
                    <table class="w-full">
                        <thead class="border-b-2 border-solid border-black text-left">
                            <tr>
                                <th>{{ __('views.task.fields.id') }}</th>
                                <th>{{ __('views.task.fields.status_id') }}</th>
                                <th>{{ __('views.task.fields.name') }}</th>
                                <th>{{ __('views.task.fields.created_by_id') }}</th>
                                <th>{{ __('views.task.fields.assigned_to_id') }}</th>
                                <th>{{ __('views.task.fields.created_at') }}</th>
                                @auth
                                    <th>{{ __('views.actions.column_name') }}</th>
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
                                    <td>{{ $task->toArray()['created_at'] }}</td>
                                    @auth
                                        <td>
                                            @if (Auth::user()->name === $task->creator->name)
                                                <a data-confirm="Вы уверены?" data-method="delete"
                                                    class="text-red-600 hover:text-red-900"
                                                    href="{{ route('tasks.destroy', $task->id) }}">
                                                    {{ __('views.actions.delete') }} </a>
                                            @endif

                                            <a
                                                href="{{ route('tasks.edit', ['task' => $task->id]) }}">{{ __('views.actions.edit') }}</a>
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
