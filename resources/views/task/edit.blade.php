<x-app-layout>
    <x-slot name="title">{{ __('views.task.pages.edit.title') }}</x-slot>
    <x-slot name="header">
        <h1>{{ __('views.task.pages.edit.title') }}</h1>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-form-card>
            {{ Form::model($task, ['route' => ['tasks.update', 'task' => $task], 'method' => 'PATCH']) }}
            <div class="">
                <x-text-input-block entity="task" name="name" :items=$statuses required autofocus />
                <x-text-input-block entity="task" name="description" :items=$statuses />
                <x-select-input-block entity="task" name="status_id" :items=$statuses required />
                <x-select-input-block entity="task" name="assigned_to_id" :items=$execs required />
                <x-select-input-block entity="task" name="labels" :items=$labels multiple />
                <x-submit entity="task" type="edit" />
            </div>
            {{ Form::close() }}
    </div>
    <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900"
        href="{{ route('tasks.destroy', $task->id) }}">
        Удалить </a>
    </x-form-card>
</x-app-layout>
