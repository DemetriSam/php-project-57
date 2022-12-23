<x-app-layout>
    <x-slot name="title">{{ __('views.status.pages.edit.title') }}</x-slot>
    <x-slot name="header">
        {{ __('views.status.pages.edit.title') }}
        {{ Form::model($taskStatus, [
            'route' => ['task_statuses.update', $taskStatus->id],
            'method' => 'DELETE',
        ]) }}
        {{ Form::submit(__('views.delete'), ['class' => ['mt-4', 'inline-flex', 'items-center', 'px-4', 'py-2', 'bg-red-800', 'border', 'border-transparent', 'rounded-md', 'font-semibold', 'text-xs', 'text-white', 'uppercase', 'tracking-widest', 'hover:bg-gray-700', 'focus:bg-gray-700', 'active:bg-gray-900', 'focus:outline-none', 'focus:ring-2', 'focus:ring-indigo-500', 'focus:ring-offset-2', 'transition', 'ease-in-out', 'duration-150']]) }}

        {{ Form::close() }}
    </x-slot>
    <x-form-card>
        {{ Form::model($taskStatus, [
            'route' => ['task_statuses.update', $taskStatus->id],
            'method' => 'PATCH',
            'class' => 'flex flex-col gap-3',
        ]) }}
        <x-text-input-block entity="status" name="name" required autofocus />
        <x-text-input-block entity="status" name="description" />
        <x-submit entity="status" type="edit" />
        {{ Form::close() }}
    </x-form-card>
</x-app-layout>
