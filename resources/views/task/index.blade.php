<x-app-layout>
    <x-slot name="title">{{ __('views.task.pages.index.title') }}</x-slot>
    <x-slot name="header">
        <div class="flex justify-between gap-x-4 content-baseline">
            <h1 class="text-xl">{{ __('views.task.pages.index.title') }}</h1>
        </div>

    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{ Form::open(['route' => ['tasks.index'], 'method' => 'GET']) }}
        <div class="flex justify-center gap-x-2">
            <x-select-input-block entity="task" name="filter[status_id]" :items=$statuses label=0 />
            <x-select-input-block entity="task" name="filter[created_by_id]" :items=$creators label=0 />
            <x-select-input-block entity="task" name="filter[assigned_to_id]" :items=$execs label=0 />
            <x-submit entity="task" type="filter" />
        </div>
        {{ Form::close() }}
        <x-form-card>
            @auth
                <x-primary-button>
                    <a href="{{ route('tasks.create') }}">{{ __('views.task.pages.index.new') }}</a>
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
