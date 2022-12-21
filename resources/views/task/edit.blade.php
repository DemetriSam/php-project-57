<x-app-layout>
    <x-slot name="title">{{ __('views.task.pages.edit.title') }}</x-slot>
    <x-slot name="header">
        <h1>{{ __('views.task.pages.edit.title') }}</h1>
        {{ Form::model($task, [
            'route' => ['tasks.update', $task->id],
            'method' => 'DELETE',
        ]) }}
        {{ Form::submit(__('views.delete'), ['class' => ['mt-4', 'inline-flex', 'items-center', 'px-4', 'py-2', 'bg-red-800', 'border', 'border-transparent', 'rounded-md', 'font-semibold', 'text-xs', 'text-white', 'uppercase', 'tracking-widest', 'hover:bg-gray-700', 'focus:bg-gray-700', 'active:bg-gray-900', 'focus:outline-none', 'focus:ring-2', 'focus:ring-indigo-500', 'focus:ring-offset-2', 'transition', 'ease-in-out', 'duration-150']]) }}
        {{ Form::close() }}
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
    </x-form-card>
</x-app-layout>
