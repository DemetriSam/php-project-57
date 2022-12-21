<x-app-layout>
    <x-slot name="title">{{ __('views.task.pages.create.title') }}</x-slot>
    <x-slot name="header">
        {{ __('views.task.pages.create.title') }}
    </x-slot>
    <x-form-card>
        {{ Form::model($task, ['route' => 'tasks.store']) }}
        <div class="">
            <x-text-input-block entity="task" name="name" required autofocus />
            <x-text-input-block entity="task" name="description" />
            <x-select-input-block entity="task" name="status_id" :items=$statuses required />
            <x-select-input-block entity="task" name="assigned_to_id" :items=$execs required />
            <x-select-input-block entity="task" name="labels" :items=$labels multiple />
            <x-submit entity="task" type="create" />
        </div>
        {{ Form::close() }}
    </x-form-card>
</x-app-layout>
