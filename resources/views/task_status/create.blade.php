<x-app-layout>
    <x-slot name="title">{{ __('views.status.pages.create.title') }}</x-slot>
    <x-slot name="header">
        {{ __('views.status.pages.create.title') }}
    </x-slot>
    <x-form-card>
        {{ Form::model($taskStatus, ['route' => 'task_statuses.store', 'class' => 'flex flex-col gap-3']) }}
        <x-text-input-block entity="status" name="name" autofocus />
        <x-submit entity="status" type="create" />
        {{ Form::close() }}
    </x-form-card>
</x-app-layout>
