<x-app-layout>
    <x-slot name="title">{{ __('views.status.pages.create.title') }}</x-slot>
    <x-slot name="header">
        {{ __('views.status.pages.create.title') }}
    </x-slot>
    <x-form-card>
        {{ Form::model($taskStatus, ['route' => 'task_statuses.store']) }}
        <div class="">
            <x-text-input-block entity="status" name="name" required autofocus />
            <x-text-input-block entity="status" name="description" />
            <x-submit entity="status" type="create" />
        </div>
        {{ Form::close() }}
    </x-form-card>
</x-app-layout>
